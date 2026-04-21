<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    use ApiResponse, LogTrait;

    /**
     * Listar roles
     *
     * Retorna una lista paginada de roles del sistema con sus permisos asociados.
     * Soporta búsqueda por nombre de rol.
     *
     * @group Roles y Permisos
     *
     * @queryParam take integer Número de registros a retornar (1-100). Por defecto: 10. Example: 10
     * @queryParam skip integer Número de registros a saltar (offset). Por defecto: 0. Example: 0
     * @queryParam search string Término de búsqueda por nombre del rol. Example: Admin
     *
     * @response 200 scenario="Lista de roles" {
     *   "success": true,
     *   "message": "Roles obtenidos exitosamente",
     *   "data": {
     *     "records": [
     *       {
     *         "id": 1,
     *         "name": "Admin",
     *         "guard_name": "api",
     *         "created_at": "2025-01-01T00:00:00.000000Z",
     *         "updated_at": "2025-01-01T00:00:00.000000Z",
     *         "permissions": ["ver-usuarios", "crear-usuarios", "editar-usuarios"],
     *         "permissions_count": 3
     *       },
     *       {
     *         "id": 2,
     *         "name": "User",
     *         "guard_name": "api",
     *         "permissions": ["ver-usuarios"],
     *         "permissions_count": 1
     *       }
     *     ],
     *     "pagination": {
     *       "total": 5,
     *       "take": 10,
     *       "skip": 0,
     *       "pages": 1,
     *       "current_page": 1
     *     }
     *   }
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function index(Request $request)
    {
        try {
            $take = $request->input('take', 10);
            $skip = $request->input('skip', 0);
            $search = $request->input('search', '');

            // Validar parámetros de paginación
            $take = max(1, min($take, 100)); // Máximo 100 registros por página
            $skip = max(0, $skip);

            // Construir query base
            $query = Role::query();

            // Aplicar búsqueda si existe
            if (!empty($search)) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('guard_name', 'like', "%{$search}%");
            }

            // Obtener total antes de paginar
            $total = $query->count();

            // Aplicar paginación
            $roles = $query->with('permissions:id,name')
                ->skip($skip)
                ->take($take)
                ->get()
                ->map(function ($role) {
                    return [
                        'id' => $role->id,
                        'name' => $role->name,
                        'guard_name' => $role->guard_name,
                        'created_at' => $role->created_at,
                        'updated_at' => $role->updated_at,
                        'permissions' => $role->permissions->pluck('name')->toArray(),
                        'permissions_count' => $role->permissions->count(),
                    ];
                });

            return $this->successResponse([
                'records' => $roles,
                'pagination' => [
                    'total' => $total,
                    'take' => $take,
                    'skip' => $skip,
                    'pages' => ceil($total / $take),
                    'current_page' => floor($skip / $take) + 1,
                ],
            ], __('messages.role.list_success'), 200);

        } catch (\Throwable $th) {
            $this->createLog("roles", "Error retrieving roles", 0, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }

    /**
     * Obtener rol
     *
     * Retorna los datos de un rol específico con todos sus permisos asignados.
     *
     * @group Roles y Permisos
     *
     * @urlParam id integer required ID del rol. Example: 1
     *
     * @response 200 scenario="Rol encontrado" {
     *   "success": true,
     *   "message": "Rol obtenido exitosamente",
     *   "data": {
     *     "id": 1,
     *     "name": "Admin",
     *     "guard_name": "api",
     *     "created_at": "2025-01-01T00:00:00.000000Z",
     *     "updated_at": "2025-01-01T00:00:00.000000Z",
     *     "permissions": ["ver-usuarios", "crear-usuarios", "editar-usuarios", "eliminar-usuarios"],
     *     "permissions_count": 4
     *   }
     * }
     * @response 404 scenario="Rol no encontrado" {
     *   "success": false,
     *   "message": "El rol no fue encontrado",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function show($id)
    {
        try {
            $role = Role::with('permissions:id,name')->findOrFail($id);

            $response = [
                'id' => $role->id,
                'name' => $role->name,
                'guard_name' => $role->guard_name,
                'created_at' => $role->created_at,
                'updated_at' => $role->updated_at,
                'permissions' => $role->permissions->pluck('name')->toArray(),
                'permissions_count' => $role->permissions->count(),
            ];

            return $this->successResponse($response, __('messages.role.show_success'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(__('messages.role.not_found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("roles", "Error retrieving role", $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }

    /**
     * Listar permisos
     *
     * Retorna todos los permisos disponibles en el sistema.
     * Útil para asignar permisos al crear o actualizar roles.
     *
     * @group Roles y Permisos
     *
     * @response 200 scenario="Lista de permisos" {
     *   "success": true,
     *   "message": "Permisos obtenidos exitosamente",
     *   "data": {
     *     "permissions": [
     *       { "id": 1, "name": "ver-usuarios", "guard_name": "api" },
     *       { "id": 2, "name": "crear-usuarios", "guard_name": "api" },
     *       { "id": 3, "name": "editar-usuarios", "guard_name": "api" },
     *       { "id": 4, "name": "eliminar-usuarios", "guard_name": "api" },
     *       { "id": 5, "name": "ver-roles", "guard_name": "api" }
     *     ],
     *     "count": 5
     *   }
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function permissions(Request $request)
    {
        try {
            $permissions = Permission::all(['id', 'name', 'guard_name']);

            return $this->successResponse([
                'permissions' => $permissions,
                'count' => $permissions->count(),
            ], __('messages.role.permissions_success'), 200);

        } catch (\Throwable $th) {
            $this->createLog("roles", "Error retrieving permissions", 0, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }
}
