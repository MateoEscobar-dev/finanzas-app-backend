<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Logs;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    use ApiResponse, LogTrait;

    /**
     * Display a paginated list of users.
     * GET /api/user?take=10&skip=0
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
            $query = User::query();

            // Aplicar búsqueda si existe
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('document', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            }

            // Obtener total antes de paginar
            $total = $query->count();

            // Aplicar paginación
            $users = $query->with('roles:id,name')
                ->skip($skip)
                ->take($take)
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'document' => $user->document,
                        'first_name' => $user->first_name,
                        'second_name' => $user->second_name,
                        'first_last_name' => $user->first_last_name,
                        'second_last_name' => $user->second_last_name,
                        'address' => $user->address,
                        'phone' => $user->phone,
                        'phone_ext' => $user->phone_ext,
                        'birth_day' => $user->birth_day,
                        'lang' => $user->lang,
                        'active' => $user->active,
                        'imagen' => $user->imagen,
                        'email_verified_at' => $user->email_verified_at,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                        'roles' => $user->roles->pluck('name')->toArray(),
                        'permissions' => $user->getAllPermissions()->pluck('name')->toArray(),
                    ];
                });

            return $this->successResponse([
                'records' => $users,
                'pagination' => [
                    'total' => $total,
                    'take' => $take,
                    'skip' => $skip,
                    'pages' => ceil($total / $take),
                    'current_page' => floor($skip / $take) + 1,
                ],
            ], Lang::get('Users retrieved successfully'), 200);

        } catch (\Throwable $th) {
            $this->createLog("users", "Error retrieving users", 0, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }

    /**
     * Store a newly created user in storage.
     * POST /api/user
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $validated = $request->validated();

            // Extraer el ID del rol
            $idRol = $validated['id_rol'];
            unset($validated['id_rol']);

            // Crear el usuario
            $user = User::create($validated);

            // Obtener el rol de Spatie
            $role = \Spatie\Permission\Models\Role::find($idRol);

            if (!$role) {
                $this->createLog("users", "CREATION OF THE REGISTRY - Role not found", $user->id, null, "Role ID: {$idRol}");
                $user->delete();
                return $this->errorResponse(Lang::get('The selected role does not exist'), "", 422);
            }

            // Asignar el rol al usuario
            $user->assignRole($role);

            // Obtener todos los permisos del rol y asignarlos al usuario
            $permissions = $role->permissions;
            $user->syncPermissions($permissions);

            // Registrar creación en logs
            $this->createLog("users", "CREATION OF THE REGISTRY", $user->id, "", "Role: {$role->name}");

            // Preparar respuesta
            $response = $this->buildUserResponse($user);

            return $this->successResponse($response, Lang::get('User created successfully'), 201);

        } catch (\Throwable $th) {
            $this->createLog("users", "Error creating user", 0, $th);
            return $this->errorResponse(Lang::get('There was an error creating the user'), "", 500);
        }
    }

    /**
     * Display the specified user.
     * GET /api/user/{id}
     */
    public function show($id)
    {
        try {
            $user = User::with('roles:id,name')->findOrFail($id);

            $response = $this->buildUserResponse($user);

            return $this->successResponse($response, Lang::get('User retrieved successfully'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(Lang::get('User not found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("users", "Error retrieving user", $id, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }

    /**
     * Update the specified user in storage.
     * PUT /api/user/{id}
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $inputs = $request->except(['_method', '_token', 'password', 'image']);
        try {
            $user = User::findOrFail($id);
            $validated = $request->validated();

            // Guardar datos antiguos para el log
            $oldData = $user->toArray();

            // Extraer el ID del rol si existe
            $idRol = isset($validated['id_rol']) ? $validated['id_rol'] : null;
            if ($idRol) {
                unset($validated['id_rol']);
            }

            // Si la contraseña viene vacía, no actualizar
            if (isset($validated['password']) && empty($validated['password'])) {
                unset($validated['password']);
            }

            // Actualizar usuario
            $user->update($validated);

            // Si se proporciona un nuevo rol, actualizar permisos
            if ($idRol) {
                $role = \Spatie\Permission\Models\Role::find($idRol);

                if (!$role) {
                    return $this->errorResponse(Lang::get('The selected role does not exist'), "", 422);
                }

                // Sincronizar rol (elimina roles previos y asigna el nuevo)
                $user->syncRoles($role);

                // Sincronizar permisos del nuevo rol
                $permissions = $role->permissions;
                $user->syncPermissions($permissions);

                $updateReason = "Role updated from previous role to: {$role->name}";
            } else {
                $updateReason = "User information updated";
            }

            // Registrar cambios en logs
            $resultLogs = $this->createLog("users", "UPDATE OF THE REGISTRY", $user->id, "", $updateReason);
            $this->saveChangesValues($oldData, $user, "users", $resultLogs);

            // Preparar respuesta
            $response = $this->buildUserResponse($user);

            return $this->successResponse($response, Lang::get('User updated successfully'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(Lang::get('User not found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("users", "Error updating user", $id, $th);
            return $this->errorResponse(Lang::get('There was an error updating the user'), "", 500);
        }
    }

    /**
     * Remove the specified user from storage.
     * DELETE /api/user/{id}
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            // No permitir eliminar al usuario autenticado
            if ($request->user() && $request->user()->id == $user->id) {
                return $this->errorResponse(Lang::get('You cannot delete your own user'), "", 403);
            }

            // Registrar eliminación antes de eliminar
            $this->createLog("users", "DELETION OF THE REGISTRY", $user->id, "", "User: {$user->name}");

            // Eliminar roles y permisos
            $user->syncRoles([]);
            $user->syncPermissions([]);

            // Eliminar tokens
            $user->tokens()->delete();

            // Eliminar usuario
            $user->delete();

            return $this->successResponse([], Lang::get('User deleted successfully'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(Lang::get('User not found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("users", "Error deleting user", $id, $th);
            return $this->errorResponse(Lang::get('There was an error deleting the user'), "", 500);
        }
    }

    /**
     * Build user response with all necessary data
     */
    private function buildUserResponse(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'document' => $user->document,
            'first_name' => $user->first_name,
            'second_name' => $user->second_name,
            'first_last_name' => $user->first_last_name,
            'second_last_name' => $user->second_last_name,
            'address' => $user->address,
            'phone' => $user->phone,
            'phone_ext' => $user->phone_ext,
            'birth_day' => $user->birth_day,
            'lang' => $user->lang,
            'active' => $user->active,
            'imagen' => $user->imagen,
            'email_verified_at' => $user->email_verified_at,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'roles' => $user->roles->pluck('name')->toArray(),
            'permissions' => $user->getAllPermissions()->pluck('name')->toArray(),
        ];
    }

    /**
     * Activate the specified user.
     * POST /api/user/{id}/activate
     */
    public function activate(Request $request, $id)
    {
        try {
            $row = User::where('id', $id)->first();
            if (!$row) {
                return $this->errorResponse(Lang::get('Register not found'), "", 404);
            }

            $row->active = true;
            $row->save();

            return $this->successResponse([], Lang::get('User activated successfully'), 200);

        } catch (\Throwable $th) {
            $this->createLog("users", "Error activating user", $id, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }

    /**
     * Deactivate the specified user.
     * POST /api/user/{id}/deactivate
     */
    public function deactivate(Request $request, $id)
    {
        try {
            $row = User::where('id', $id)->first();
            if (!$row) {
                return $this->errorResponse(Lang::get('Register not found'), "", 404);
            }

            $row->active = false;
            $row->save();

            return $this->successResponse([], Lang::get('User deactivated successfully'), 200);

        } catch (\Throwable $th) {
            $this->createLog("users", "Error deactivating user", $id, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }

    /**
     * Get user activity history.
     * GET /api/user/{id}/history
     */
    public function history(Request $request, $id)
    {
        try {
            $user = User::select(["*"])->where("id", $id)->first();
            if($user){
                $logs = Logs::select(["*"])->where([["table", "users"], ["id_item", $id]])->with('usuario')->get()->toArray();
                return $this->successResponse([
                    'user' => $user,
                    'logs' => $logs,
                ], Lang::get('User history retrieved successfully'), 200);
            }
        } catch (\Throwable $th) {
            $this->createLog("users", "Error retrieving user history", $id, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }
    /**
     * Get user language preference.
     * GET /api/user/{id}/language
     */
    public function language(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            // actualizar lenguaje
            $user->lang = $request->input('lang');
            $user->save();
            return $this->successResponse(['lang' => $user->lang], Lang::get('User language updated successfully'), 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(Lang::get('User not found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("users", "Error retrieving user language", $id, $th);
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 500);
        }
    }
}

