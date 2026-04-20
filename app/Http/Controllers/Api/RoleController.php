<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    use ApiResponse, LogTrait;

    /**
     * Display a paginated list of roles.
     * GET /api/roles?take=10&skip=0
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
            ], Lang::get('Roles retrieved successfully'), 200);

        } catch (\Throwable $th) {
            $this->createLog("roles", "Error retrieving roles", 0, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }

    /**
     * Display the specified role with its permissions.
     * GET /api/roles/{id}
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

            return $this->successResponse($response, Lang::get('Role retrieved successfully'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(Lang::get('Role not found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("roles", "Error retrieving role", $id, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }

    /**
     * Get all available permissions.
     * GET /api/roles/permissions/list
     */
    public function permissions(Request $request)
    {
        try {
            $permissions = Permission::all(['id', 'name', 'guard_name']);

            return $this->successResponse([
                'permissions' => $permissions,
                'count' => $permissions->count(),
            ], Lang::get('Permissions retrieved successfully'), 200);

        } catch (\Throwable $th) {
            $this->createLog("roles", "Error retrieving permissions", 0, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }
}
