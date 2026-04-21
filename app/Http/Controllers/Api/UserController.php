<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AssignUserRolesRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\SyncUserPermissionsRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Traits\ApiResponse;
use App\Traits\LogTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse, LogTrait;

    public function __construct(
        private readonly UserService $userService,
    ) {}

    // -------------------------------------------------------------------------
    // CRUD
    // -------------------------------------------------------------------------

    /**
     * Listar usuarios
     *
     * Retorna una lista paginada de usuarios del sistema.
     * Soporta búsqueda por nombre, email o documento.
     *
     * @group Usuarios
     *
     * @queryParam take integer Número de registros a retornar (1-100). Por defecto: 10. Example: 10
     * @queryParam skip integer Número de registros a saltar (offset). Por defecto: 0. Example: 0
     * @queryParam search string Término de búsqueda (nombre, email o documento). Example: Juan
     *
     * @response 200 scenario="Lista de usuarios" {
     *   "status": "Success",
     *   "message": "Usuarios obtenidos exitosamente",
     *   "data": {
     *     "records": [{"id": 1, "name": "Juan Pérez", "email": "usuario@ejemplo.com", "active": 1, "roles": [{"id": 1, "name": "Administrator"}]}],
     *     "pagination": {"total": 50, "take": 10, "skip": 0, "pages": 5, "current_page": 1}
     *   },
     *   "code": 200
     * }
     * @response 401 scenario="No autenticado" {"message": "Unauthenticated."}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function index(Request $request)
    {
        if (! $request->user()->can('users.view')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $take   = (int) $request->input('take', 10);
            $skip   = (int) $request->input('skip', 0);
            $search = (string) $request->input('search', '');

            $result = $this->userService->list($take, $skip, $search);
            $result['records'] = UserResource::collection($result['records']);

            return $this->successResponse($result, __('messages.user.list_success'), 200);

        } catch (\Throwable $th) {
            $this->createLog('users', 'Error retrieving users', 0, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Crear usuario
     *
     * Crea un nuevo usuario en el sistema y le asigna los roles indicados.
     * La contraseña debe enviarse encriptada en AES-256-CBC.
     *
     * @group Usuarios
     *
     * @bodyParam document string required Documento de identidad (único, máx. 20 caracteres). Example: 1036961469
     * @bodyParam first_name string required Primer nombre (máx. 100 caracteres). Example: Harol
     * @bodyParam second_name string Segundo nombre (opcional). Example: Mateo
     * @bodyParam first_last_name string required Primer apellido (máx. 100 caracteres). Example: Escobar
     * @bodyParam second_last_name string Segundo apellido (opcional). Example: Correa
     * @bodyParam email string required Correo electrónico válido y único. Example: mateo@ejemplo.com
     * @bodyParam password string required Contraseña encriptada AES-256-CBC. Example: {"salt":"...","iv":"...","ciphertext":"..."}
     * @bodyParam phone string required Teléfono en formato E.164. Example: +573138853031
     * @bodyParam phone_ext numeric Extensión (opcional). Example: 124
     * @bodyParam birth_day string required Fecha de nacimiento YYYY-MM-DD. Mayor de 18 años. Example: 1997-10-20
     * @bodyParam roles integer[] IDs de roles a asignar (opcional). Example: [1, 2]
     *
     * @response 201 scenario="Usuario creado" {"status": "Success", "message": "Usuario creado exitosamente", "data": {"id": 10, "name": "Harol Escobar"}, "code": 201}
     * @response 422 scenario="Validación fallida" {"status": "Error", "message": "Los datos proporcionados no son válidos", "errors": {"email": ["El correo electrónico ya está registrado."]}, "code": 422}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function store(StoreUserRequest $request)
    {
        if (! $request->user()->can('users.add')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user = $this->userService->create($request->validated());
            $this->createLog('users', 'CREATION OF THE REGISTRY', $user->id, '', 'Roles: ' . $user->roles->pluck('name')->implode(','));

            return $this->successResponse(new UserResource($user), __('messages.user.created'), 201);

        } catch (\RuntimeException $e) {
            return $this->errorResponse($e->getMessage(), '', 422);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error creating user', 0, $th);
            return $this->errorResponse(__('messages.user.create_error'), '', 500);
        }
    }

    /**
     * Obtener usuario
     *
     * Retorna los datos completos de un usuario específico, incluyendo roles y permisos.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario. Example: 1
     *
     * @response 200 scenario="Usuario encontrado" {"status": "Success", "message": "Usuario obtenido exitosamente", "data": {"id": 1, "name": "Juan Pérez", "roles": [{"id": 1, "name": "Administrator"}]}, "code": 200}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El usuario no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function show(Request $request, $id)
    {
        if (! $request->user()->can('users.view')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user = $this->userService->findOrFail((int) $id);
            return $this->successResponse(new UserResource($user), __('messages.user.show_success'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.user.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error retrieving user', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Actualizar usuario
     *
     * Actualiza los datos de un usuario existente. Solo se procesan los campos enviados.
     * Si se envía `roles`, se sincronizan con `syncRoles()`. La contraseña es opcional.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario a actualizar. Example: 1
     *
     * @bodyParam first_name string Primer nombre. Example: Juan
     * @bodyParam email string Correo electrónico. Example: actualizado@ejemplo.com
     * @bodyParam password string Contraseña AES-256-CBC (opcional). Example: {"salt":"...","iv":"...","ciphertext":"..."}
     * @bodyParam roles integer[] IDs de roles a sincronizar (opcional). Example: [1]
     *
     * @response 200 scenario="Actualizado" {"status": "Success", "message": "Usuario actualizado exitosamente", "data": {"id": 1, "name": "Juan Pérez"}, "code": 200}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El usuario no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if (! $request->user()->can('users.edit')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user    = $this->userService->findOrFail((int) $id);
            $oldData = $user->toArray();

            $user       = $this->userService->update($user, $request->validated());
            $resultLogs = $this->createLog('users', 'UPDATE OF THE REGISTRY', $user->id, '', 'User information updated');
            $this->saveChangesValues($oldData, $user, 'users', $resultLogs);

            return $this->successResponse(new UserResource($user), __('messages.user.updated'), 200);

        } catch (\RuntimeException $e) {
            return $this->errorResponse($e->getMessage(), '', 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.user.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error updating user', $id, $th);
            return $this->errorResponse(__('messages.user.update_error'), '', 500);
        }
    }

    /**
     * Eliminar usuario
     *
     * Elimina permanentemente un usuario junto con sus roles, permisos y tokens.
     * No se puede eliminar al usuario autenticado.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario a eliminar. Example: 5
     *
     * @response 200 scenario="Eliminado" {"status": "Success", "message": "Usuario eliminado exitosamente", "data": [], "code": 200}
     * @response 403 scenario="Cuenta propia" {"status": "Error", "message": "No puedes eliminar tu propia cuenta", "code": 403}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El usuario no fue encontrado", "code": 404}
     */
    public function destroy(Request $request, $id)
    {
        if (! $request->user()->can('users.destroy')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user = $this->userService->findOrFail((int) $id);
            $this->createLog('users', 'DELETION OF THE REGISTRY', $user->id, '', "User: {$user->name}");
            $this->userService->delete($user, $request->user()->id);

            return $this->successResponse([], __('messages.user.deleted'), 200);

        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), '', 403);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.user.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error deleting user', $id, $th);
            return $this->errorResponse(__('messages.user.delete_error'), '', 500);
        }
    }

    // -------------------------------------------------------------------------
    // Activate / Deactivate
    // -------------------------------------------------------------------------

    /**
     * Activar usuario
     *
     * Activa un usuario que se encontraba inactivo.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario a activar. Example: 3
     *
     * @response 200 scenario="Activado" {"status": "Success", "message": "Usuario activado exitosamente", "data": {"id": 3, "active": 1}, "code": 200}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El usuario no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function activate(Request $request, $id)
    {
        if (! $request->user()->can('users.activate')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user = $this->userService->findOrFail((int) $id);
            $user = $this->userService->setActive($user, true);
            $this->createLog('users', 'ACTIVATE REGISTRY', $user->id);

            return $this->successResponse(new UserResource($user), __('messages.user.activated'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.general.record_not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error activating user', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Desactivar usuario
     *
     * Desactiva un usuario impidiéndole iniciar sesión.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario a desactivar. Example: 3
     *
     * @response 200 scenario="Desactivado" {"status": "Success", "message": "Usuario desactivado exitosamente", "data": {"id": 3, "active": 0}, "code": 200}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El usuario no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function deactivate(Request $request, $id)
    {
        if (! $request->user()->can('users.activate')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user = $this->userService->findOrFail((int) $id);
            $user = $this->userService->setActive($user, false);
            $this->createLog('users', 'DEACTIVATE REGISTRY', $user->id);

            return $this->successResponse(new UserResource($user), __('messages.user.deactivated'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.general.record_not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error deactivating user', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    // -------------------------------------------------------------------------
    // History
    // -------------------------------------------------------------------------

    /**
     * Historial del usuario
     *
     * Retorna el historial de cambios y actividad registrada del usuario especificado.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario. Example: 1
     *
     * @response 200 scenario="Historial obtenido" {
     *   "status": "Success",
     *   "message": "Historial obtenido exitosamente",
     *   "data": {
     *     "user": {"id": 1, "name": "Juan Pérez"},
     *     "logs": [{"id": 10, "operation": "UPDATE OF THE REGISTRY", "reason": "User information updated"}]
     *   },
     *   "code": 200
     * }
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El usuario no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function history(Request $request, $id)
    {
        if (! $request->user()->can('users.historial')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user = $this->userService->findOrFail((int) $id);
            $logs = $this->userService->getHistory((int) $id);

            return $this->successResponse([
                'user' => new UserResource($user),
                'logs' => $logs,
            ], __('messages.user.history_success'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.user.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error retrieving user history', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    // -------------------------------------------------------------------------
    // Permissions & Roles
    // -------------------------------------------------------------------------

    /**
     * Permisos del usuario
     *
     * Retorna los permisos directos y los permisos heredados por rol, diferenciados.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario. Example: 1
     *
     * @response 200 scenario="Permisos obtenidos" {
     *   "status": "Success",
     *   "message": "Permisos obtenidos exitosamente",
     *   "data": {"direct_permissions": ["users.add"], "role_permissions": ["users.view", "users.edit"]},
     *   "code": 200
     * }
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El usuario no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function getUserPermissions(Request $request, $id)
    {
        if (! $request->user()->can('users.view')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user        = $this->userService->findOrFail((int) $id);
            $permissions = $this->userService->getPermissions($user);

            return $this->successResponse($permissions, __('messages.user.permissions_success'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.user.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error retrieving user permissions', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Sincronizar permisos directos del usuario
     *
     * Reemplaza los permisos directos con los enviados. Usa `syncPermissions()` de Spatie.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario. Example: 1
     *
     * @bodyParam permissions string[] required Nombres de permisos a asignar. Example: ["users.add", "users.edit"]
     *
     * @response 200 scenario="Sincronizados" {"status": "Success", "message": "Permisos sincronizados exitosamente", "data": {"id": 1, "permissions": ["users.add"]}, "code": 200}
     * @response 422 scenario="Permiso inválido" {"status": "Error", "message": "Los datos proporcionados no son válidos", "errors": {"permissions.0": ["Uno o más permisos especificados no existen."]}, "code": 422}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function syncUserPermissions(SyncUserPermissionsRequest $request, $id)
    {
        if (! $request->user()->can('users.edit')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user = $this->userService->findOrFail((int) $id);
            $user = $this->userService->syncPermissions($user, $request->input('permissions', []));
            $this->createLog('users', 'SYNC PERMISSIONS', $user->id, '', implode(',', $request->input('permissions', [])));

            return $this->successResponse(new UserResource($user), __('messages.user.permissions_synced'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.user.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error syncing user permissions', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Asignar roles al usuario
     *
     * Reemplaza los roles del usuario con los enviados. Usa `syncRoles()` de Spatie.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario. Example: 1
     *
     * @bodyParam roles integer[] required IDs de roles a asignar. Example: [1, 2]
     *
     * @response 200 scenario="Roles sincronizados" {"status": "Success", "message": "Roles sincronizados exitosamente", "data": {"id": 1, "roles": [{"id": 1, "name": "Administrator"}]}, "code": 200}
     * @response 422 scenario="Rol inválido" {"status": "Error", "message": "Los datos proporcionados no son válidos", "errors": {"roles.0": ["Uno o más roles especificados no existen."]}, "code": 422}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function assignRoles(AssignUserRolesRequest $request, $id)
    {
        if (! $request->user()->can('users.edit')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $user = $this->userService->findOrFail((int) $id);
            $user = $this->userService->syncRoles($user, $request->input('roles', []));
            $this->createLog('users', 'SYNC ROLES', $user->id, '', implode(',', $request->input('roles', [])));

            return $this->successResponse(new UserResource($user), __('messages.user.roles_synced'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.user.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error syncing user roles', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    // -------------------------------------------------------------------------
    // Language (mantiene compatibilidad)
    // -------------------------------------------------------------------------

    /**
     * Actualizar idioma del usuario
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario. Example: 1
     * @bodyParam lang string required Código de idioma (es|en). Example: en
     *
     * @response 200 scenario="Idioma actualizado" {"status": "Success", "message": "Idioma actualizado exitosamente", "data": {"lang": "en"}, "code": 200}
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El usuario no fue encontrado", "code": 404}
     */
    public function language(Request $request, $id)
    {
        try {
            $user = $this->userService->findOrFail((int) $id);
            $this->userService->update($user, ['lang' => $request->input('lang')]);
            $user->refresh();

            return $this->successResponse(['lang' => $user->lang], __('messages.user.language_updated'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.user.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('users', 'Error updating user language', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }
}
