<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Traits\ApiResponse;
use App\Traits\LogTrait;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use ApiResponse, LogTrait;

    public function __construct(
        private readonly PermissionRepositoryInterface $permissionRepository,
    ) {}

    /**
     * Listar permisos
     *
     * Retorna todos los permisos del sistema paginados.
     * Cada permiso incluye el campo `module` extraído del prefijo del nombre
     * (ej: `users.add` → módulo `users`).
     *
     * @group Permisos
     *
     * @queryParam take integer Número de registros a retornar (1-100). Por defecto: 50. Example: 50
     * @queryParam skip integer Número de registros a saltar (offset). Por defecto: 0. Example: 0
     * @queryParam search string Término de búsqueda por nombre del permiso. Example: users
     *
     * @response 200 scenario="Lista de permisos" {
     *   "status": "Success",
     *   "message": "Permisos obtenidos exitosamente",
     *   "data": {
     *     "records": [
     *       {"id": 1, "name": "users.view", "module": "users", "guard_name": "api"},
     *       {"id": 2, "name": "users.add",  "module": "users", "guard_name": "api"},
     *       {"id": 3, "name": "roles.view", "module": "roles", "guard_name": "api"}
     *     ],
     *     "pagination": {"total": 15, "take": 50, "skip": 0, "pages": 1, "current_page": 1}
     *   },
     *   "code": 200
     * }
     * @response 401 scenario="No autenticado" {"message": "Unauthenticated."}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function index(Request $request)
    {
        if (! $request->user()->can('permissions.view')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $take   = (int) $request->input('take', 50);
            $skip   = (int) $request->input('skip', 0);
            $search = (string) $request->input('search', '');

            $result            = $this->permissionRepository->paginate($take, $skip, $search);
            $result['records'] = PermissionResource::collection($result['records']);

            return $this->successResponse($result, __('messages.role.permissions_success'), 200);

        } catch (\Throwable $th) {
            $this->createLog('permissions', 'Error retrieving permissions', 0, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Obtener permiso
     *
     * Retorna los datos de un permiso específico, incluyendo el módulo al que pertenece.
     *
     * @group Permisos
     *
     * @urlParam id integer required ID del permiso. Example: 1
     *
     * @response 200 scenario="Permiso encontrado" {
     *   "status": "Success",
     *   "message": "Permiso obtenido exitosamente",
     *   "data": {"id": 1, "name": "users.view", "module": "users", "guard_name": "api"},
     *   "code": 200
     * }
     * @response 404 scenario="No encontrado" {"status": "Error", "message": "El permiso no fue encontrado", "code": 404}
     * @response 403 scenario="Sin permiso" {"status": "Error", "message": "No tienes permiso para realizar esta acción.", "code": 403}
     */
    public function show(Request $request, $id)
    {
        if (! $request->user()->can('permissions.view')) {
            return $this->errorResponse(__('messages.general.forbidden'), '', 403);
        }

        try {
            $permission = $this->permissionRepository->findByIdOrFail((int) $id);

            return $this->successResponse(new PermissionResource($permission), __('messages.permission.show_success'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->errorResponse(__('messages.permission.not_found'), '', 404);
        } catch (\Throwable $th) {
            $this->createLog('permissions', 'Error retrieving permission', $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }
}
