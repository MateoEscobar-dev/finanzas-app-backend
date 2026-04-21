<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\SyncRolePermissionsRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use App\Traits\ApiResponse;
use App\Traits\LogTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ApiResponse, LogTrait;

    public function __construct(
        private readonly RoleService $roleService,
    ) {}

    // -------------------------------------------------------------------------
    // CRUD
    // -------------------------------------------------------------------------

    /**
     * Listar roles
     *
     * Retorna una lista paginada de roles del sistema con sus permisos asociados.
     *
     * @group Roles y Permisos
     *
     * @queryParam take integer Número de registros a retornar (1-100). Por defecto: 10. Example: 10
     * @queryParam skip integer Número de registros a saltar (offset). Por defecto: 0. Example: 0
     * @queryParam search string Término de búsqueda por nombre del rol. Example: Admin
     *
     * @response 200 scenario="Lista de roles" {
     *   "status": "Success",
     *   "message": "Roles obtenidos exitosamente",
     *   "data": {
     *     "records": [{"id": 1, "name": "Administrator", "description": "Rol con acceso total", "active": true, "permissions": {"users": ["users.view"]}, "permissions_count": 1}],
     *     "pagination": {"total": 5, "take": 10, "skip": 0, "pages": 1, "current_page": 1}
     *   },
     *   "code": 200
     * }
     * @response 401 scenario="No autenticado" {"message": "Unauthenticated."}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function index(Request $request)
    {
        if (! $request->user()->can('roles.view')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $take   = (int) $request->input('take', 10);
            $skip   = (int) $request->input('skip', 0);
            $search = (string) $request->input('search', '');

            $result            = $this->roleService->list($take, $skip, $search);
            $result['records'] = RoleResource::collection($result['records']);

            return $this->successResponse($result, __('messages.role.list_success'), 200);

        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error retrieving roles', 0, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Crear rol
     *
     * Crea un nuevo rol y opcionalmente le asigna permisos.
     *
     * @group Roles y Permisos
     *
     * @bodyParam name string required Nombre del rol (único, máx. 100 caracteres). Example: Editor
     * @bodyParam description string Descripción del rol (opcional, máx. 255 caracteres). Example: Rol con acceso de edición
     * @bodyParam active boolean Si el rol está activo (por defecto: true). Example: true
     * @bodyParam permissions string[] Nombres de permisos a asignar. Example: ["users.view", "users.edit"]
     *
     * @response 201 scenario="Rol creado" {"status": "Success", "message": "Rol creado exitosamente", "data": {"id": 3, "name": "Editor", "description": "Rol con acceso de edición", "active": true, "permissions": {"users": ["users.view", "users.edit"]}}, "code": 201}
     * @response 422 scenario="Nombre duplicado" {"status": "Error", "message": "Los datos proporcionados no son válidos", "errors": {"name": ["El nombre del rol ya está en uso."]}, "code": 422}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function store(StoreRoleRequest $request)
    {
        if (! $request->user()->can('roles.add')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $role = $this->roleService->create($request->validated());
            $this->createLog('roles', 'CREATION OF THE REGISTRY', $role->id);

            return $this->successResponse(new RoleResource($role), __('messages.role.created'), 201);

        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error creating role', 0, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Obtener rol
     *
     * Retorna los datos de un rol específico con sus permisos agrupados por módulo.
     *
     * @group Roles y Permisos
     *
     * @urlParam id integer required ID del rol. Example: 1
     *
     * @response 200 scenario="Rol encontrado" {
     *   "status": "Success",
     *   "message": "Rol obtenido exitosamente",
     *   "data": {
     *     "id": 1,
     *     "name": "Administrator",
     *     "description": "Rol con acceso total",
     *     "active": true,
     *     "permissions": {
     *       "users": ["users.view", "users.add", "users.edit", "users.destroy"],
     *       "roles": ["roles.view", "roles.edit"]
     *     },
     *     "permissions_count": 6
     *   },
     *   "code": 200
     * }
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El rol no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function show(Request $request, $id)
    {
        if (! $request->user()->can('roles.view')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $role = $this->roleService->findOrFail((int) $id);
            return $this->successResponse(new RoleResource($role), __('messages.role.show_success'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.role.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error retrieving role', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Actualizar rol
     *
     * Actualiza los campos de un rol existente. Si se envía `permissions`, se sincronizan.
     *
     * @group Roles y Permisos
     *
     * @urlParam id integer required ID del rol a actualizar. Example: 1
     *
     * @bodyParam name string Nuevo nombre del rol (único). Example: Super Admin
     * @bodyParam description string Descripción del rol. Example: Rol principal del sistema
     * @bodyParam active boolean Estado del rol. Example: true
     * @bodyParam permissions string[] Permisos a sincronizar (opcional). Example: ["users.view", "users.edit"]
     *
     * @response 200 scenario="Actualizado" {"status": "Success", "message": "Rol actualizado exitosamente", "data": {"id": 1, "name": "Super Admin"}, "code": 200}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El rol no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        if (! $request->user()->can('roles.edit')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $role = $this->roleService->findOrFail((int) $id);
            $role = $this->roleService->update($role, $request->validated());
            $this->createLog('roles', 'UPDATE OF THE REGISTRY', $role->id);

            return $this->successResponse(new RoleResource($role), __('messages.role.updated'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.role.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error updating role', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Eliminar rol
     *
     * Elimina un rol del sistema. No se puede eliminar si tiene usuarios asignados.
     *
     * @group Roles y Permisos
     *
     * @urlParam id integer required ID del rol a eliminar. Example: 3
     *
     * @response 200 scenario="Eliminado" {"status": "Success", "message": "Rol eliminado exitosamente", "data": [], "code": 200}
     * @response 409 scenario="Tiene usuarios" {"status": "Error", "message": "El rol tiene usuarios asignados y no puede eliminarse.", "code": 409}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El rol no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function destroy(Request $request, $id)
    {
        if (! $request->user()->can('roles.destroy')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $role = $this->roleService->findOrFail((int) $id);
            $this->createLog('roles', 'DELETION OF THE REGISTRY', $role->id, '', "Role: {$role->name}");
            $this->roleService->delete($role);

            return $this->successResponse([], __('messages.role.deleted'), 200);

        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), '', 409);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.role.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error deleting role', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    // -------------------------------------------------------------------------
    // Activate / Deactivate
    // -------------------------------------------------------------------------

    /**
     * Activar rol
     *
     * Activa un rol que se encontraba inactivo.
     *
     * @group Roles y Permisos
     *
     * @urlParam id integer required ID del rol a activar. Example: 2
     *
     * @response 200 scenario="Activado" {"status": "Success", "message": "Rol activado exitosamente", "data": {"id": 2, "name": "Editor", "active": true}, "code": 200}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El rol no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function activate(Request $request, $id)
    {
        if (! $request->user()->can('roles.activate')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $role = $this->roleService->findOrFail((int) $id);
            $role = $this->roleService->setActive($role, true);
            $this->createLog('roles', 'ACTIVATE REGISTRY', $role->id);

            return $this->successResponse(new RoleResource($role), __('messages.role.activated'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.role.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error activating role', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Desactivar rol
     *
     * Desactiva un rol sin eliminarlo del sistema.
     *
     * @group Roles y Permisos
     *
     * @urlParam id integer required ID del rol a desactivar. Example: 2
     *
     * @response 200 scenario="Desactivado" {"status": "Success", "message": "Rol desactivado exitosamente", "data": {"id": 2, "name": "Editor", "active": false}, "code": 200}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El rol no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function deactivate(Request $request, $id)
    {
        if (! $request->user()->can('roles.activate')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $role = $this->roleService->findOrFail((int) $id);
            $role = $this->roleService->setActive($role, false);
            $this->createLog('roles', 'DEACTIVATE REGISTRY', $role->id);

            return $this->successResponse(new RoleResource($role), __('messages.role.deactivated'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.role.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error deactivating role', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    // -------------------------------------------------------------------------
    // Permissions
    // -------------------------------------------------------------------------

    /**
     * Sincronizar permisos del rol
     *
     * Reemplaza todos los permisos del rol con los enviados en el payload.
     * Usa `syncPermissions()` de Spatie.
     *
     * @group Roles y Permisos
     *
     * @urlParam id integer required ID del rol. Example: 1
     *
     * @bodyParam permissions string[] required Nombres de permisos a asignar. Example: ["users.view", "users.add", "users.edit"]
     *
     * @response 200 scenario="Permisos sincronizados" {
     *   "status": "Success",
     *   "message": "Permisos del rol sincronizados exitosamente",
     *   "data": {"id": 1, "name": "Administrator", "permissions": {"users": ["users.view", "users.add"]}},
     *   "code": 200
     * }
     * @response 422 scenario="Permiso inválido" {"status": "Error", "message": "Los datos proporcionados no son válidos", "errors": {"permissions.0": ["Uno o más permisos especificados no existen."]}, "code": 422}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El rol no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function syncPermissions(SyncRolePermissionsRequest $request, $id)
    {
        if (! $request->user()->can('roles.edit')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $role = $this->roleService->findOrFail((int) $id);
            $role = $this->roleService->syncPermissions($role, $request->input('permissions', []));
            $this->createLog('roles', 'SYNC PERMISSIONS', $role->id, '', implode(',', $request->input('permissions', [])));

            return $this->successResponse(new RoleResource($role), __('messages.role.permissions_synced'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.role.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error syncing role permissions', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    // -------------------------------------------------------------------------
    // List permissions (mantiene compatibilidad)
    // -------------------------------------------------------------------------

    /**
     * Listar permisos disponibles
     *
     * @deprecated Usar GET /api/permissions en su lugar.
     * @group Roles y Permisos
     *
     * @response 200 scenario="Lista de permisos" {"status": "Success", "message": "Permisos obtenidos exitosamente", "data": {"records": [{"id": 1, "name": "users.view", "module": "users"}], "pagination": {"total": 10}}, "code": 200}
     */
    public function permissions(Request $request)
    {
        if (! $request->user()->can('permissions.view')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $take   = (int) $request->input('take', 100);
            $skip   = (int) $request->input('skip', 0);
            $search = (string) $request->input('search', '');

            /** @var \App\Repositories\Contracts\PermissionRepositoryInterface */
            $permRepo = app(\App\Repositories\Contracts\PermissionRepositoryInterface::class);
            $result   = $permRepo->paginate($take, $skip, $search);

            $result['records'] = \App\Http\Resources\PermissionResource::collection($result['records']);

            return $this->successResponse($result, __('messages.role.permissions_success'), 200);

        } catch (\Throwable $th) {
            $this->createLog('roles', 'Error retrieving permissions', 0, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }
}
