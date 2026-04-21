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

class UserController extends Controller
{
    use ApiResponse, LogTrait;

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
     *   "success": true,
     *   "message": "Usuarios obtenidos exitosamente",
     *   "data": {
     *     "records": [
     *       {
     *         "id": 1,
     *         "name": "Juan Pérez",
     *         "email": "usuario@ejemplo.com",
     *         "document": "****",
     *         "first_name": "Juan",
     *         "second_name": null,
     *         "first_last_name": "Pérez",
     *         "second_last_name": null,
     *         "address": "****",
     *         "phone": "****",
     *         "phone_ext": null,
     *         "birth_day": "1990-05-15",
     *         "lang": "es",
     *         "active": 1,
     *         "imagen": null,
     *         "email_verified_at": null,
     *         "created_at": "2025-01-01T00:00:00.000000Z",
     *         "updated_at": "2025-01-01T00:00:00.000000Z",
     *         "roles": ["User"],
     *         "permissions": ["ver-usuarios"]
     *       }
     *     ],
     *     "pagination": {
     *       "total": 50,
     *       "take": 10,
     *       "skip": 0,
     *       "pages": 5,
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
            ], __('messages.user.list_success'), 200);

        } catch (\Throwable $th) {
            $this->createLog("users", "Error retrieving users", 0, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }

    /**
     * Crear usuario
     *
     * Crea un nuevo usuario en el sistema y le asigna un rol con sus permisos correspondientes.
     * El campo `password` debe enviarse encriptado en AES-256-CBC.
     *
     * @group Usuarios
     *
     * @bodyParam document string required Documento de identidad (único, máx. 20 caracteres). Example: 12345678
     * @bodyParam first_name string required Primer nombre (máx. 100 caracteres). Example: Juan
     * @bodyParam second_name string Segundo nombre (opcional). Example: Carlos
     * @bodyParam first_last_name string required Primer apellido (máx. 100 caracteres). Example: Pérez
     * @bodyParam second_last_name string Segundo apellido (opcional). Example: Gómez
     * @bodyParam email string required Correo electrónico válido y único. Example: nuevo@ejemplo.com
     * @bodyParam password string required Contraseña encriptada AES-256-CBC. Example: U2FsdGVkX1+xyz...
     * @bodyParam phone string required Teléfono en formato E.164. Example: +573001234567
     * @bodyParam phone_ext numeric Extensión telefónica (opcional). Example: 101
     * @bodyParam birth_day string required Fecha de nacimiento YYYY-MM-DD. Debe ser mayor de 18 años. Example: 1990-05-15
     * @bodyParam address string Dirección (opcional). Example: Calle 123 # 45-67
     * @bodyParam lang string Idioma preferido del usuario (es|en). Por defecto: es. Example: es
     * @bodyParam id_rol integer required ID del rol a asignar (ver GET /api/roles). Example: 1
     *
     * @response 201 scenario="Usuario creado" {
     *   "success": true,
     *   "message": "Usuario creado exitosamente",
     *   "data": {
     *     "id": 10,
     *     "name": "Juan Pérez",
     *     "email": "nuevo@ejemplo.com",
     *     "document": "****",
     *     "first_name": "Juan",
     *     "second_name": "Carlos",
     *     "first_last_name": "Pérez",
     *     "second_last_name": "Gómez",
     *     "address": "****",
     *     "phone": "****",
     *     "phone_ext": 101,
     *     "birth_day": "1990-05-15",
     *     "lang": "es",
     *     "active": 1,
     *     "imagen": null,
     *     "roles": ["User"],
     *     "permissions": ["ver-usuarios"]
     *   }
     * }
     * @response 422 scenario="Rol no encontrado" {
     *   "success": false,
     *   "message": "El rol especificado no existe",
     *   "errors": ""
     * }
     * @response 422 scenario="Validación fallida" {
     *   "success": false,
     *   "message": "Los datos proporcionados no son válidos",
     *   "errors": { "email": ["El correo electrónico ya está registrado."] }
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
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
                return $this->errorResponse(__('messages.user.role_not_found'), "", 422);
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

            return $this->successResponse($response, __('messages.user.created'), 201);

        } catch (\Throwable $th) {
            $this->createLog("users", "Error creating user", 0, $th);
            return $this->errorResponse(__('messages.user.create_error'), "", 500);
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
     * @response 200 scenario="Usuario encontrado" {
     *   "success": true,
     *   "message": "Usuario obtenido exitosamente",
     *   "data": {
     *     "id": 1,
     *     "name": "Juan Pérez",
     *     "email": "usuario@ejemplo.com",
     *     "document": "****",
     *     "first_name": "Juan",
     *     "second_name": null,
     *     "first_last_name": "Pérez",
     *     "second_last_name": null,
     *     "address": "****",
     *     "phone": "****",
     *     "phone_ext": null,
     *     "birth_day": "1990-05-15",
     *     "lang": "es",
     *     "active": 1,
     *     "imagen": null,
     *     "email_verified_at": null,
     *     "created_at": "2025-01-01T00:00:00.000000Z",
     *     "updated_at": "2025-01-01T00:00:00.000000Z",
     *     "roles": ["User"],
     *     "permissions": ["ver-usuarios"]
     *   }
     * }
     * @response 404 scenario="Usuario no encontrado" {
     *   "success": false,
     *   "message": "El usuario no fue encontrado",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function show($id)
    {
        try {
            $user = User::with('roles:id,name')->findOrFail($id);

            $response = $this->buildUserResponse($user);

            return $this->successResponse($response, __('messages.user.show_success'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(__('messages.user.not_found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("users", "Error retrieving user", $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }

    /**
     * Actualizar usuario
     *
     * Actualiza los datos de un usuario existente. Solo se procesan los campos enviados.
     * Si se envía `id_rol`, se sincroniza el rol y sus permisos.
     * No se actualiza la contraseña si se envía vacía.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario a actualizar. Example: 1
     *
     * @bodyParam document string Documento de identidad (único). Example: 12345678
     * @bodyParam first_name string Primer nombre. Example: Juan
     * @bodyParam second_name string Segundo nombre (opcional). Example: Carlos
     * @bodyParam first_last_name string Primer apellido. Example: Pérez
     * @bodyParam second_last_name string Segundo apellido (opcional). Example: Gómez
     * @bodyParam email string Correo electrónico válido y único. Example: actualizado@ejemplo.com
     * @bodyParam phone string Teléfono en formato E.164. Example: +573001234567
     * @bodyParam phone_ext numeric Extensión telefónica (opcional). Example: 101
     * @bodyParam birth_day string Fecha de nacimiento YYYY-MM-DD. Example: 1990-05-15
     * @bodyParam address string Dirección (opcional). Example: Calle 123 # 45-67
     * @bodyParam lang string Idioma preferido (es|en). Example: es
     * @bodyParam id_rol integer ID del nuevo rol a asignar. Example: 2
     *
     * @response 200 scenario="Usuario actualizado" {
     *   "success": true,
     *   "message": "Usuario actualizado exitosamente",
     *   "data": {
     *     "id": 1,
     *     "name": "Juan Pérez",
     *     "email": "actualizado@ejemplo.com",
     *     "roles": ["Admin"],
     *     "permissions": ["ver-usuarios", "crear-usuarios"]
     *   }
     * }
     * @response 404 scenario="Usuario no encontrado" {
     *   "success": false,
     *   "message": "El usuario no fue encontrado",
     *   "errors": ""
     * }
     * @response 422 scenario="Rol no encontrado" {
     *   "success": false,
     *   "message": "El rol especificado no existe",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
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
                    return $this->errorResponse(__('messages.user.role_not_found'), "", 422);
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

            return $this->successResponse($response, __('messages.user.updated'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(__('messages.user.not_found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("users", "Error updating user", $id, $th);
            return $this->errorResponse(__('messages.user.update_error'), "", 500);
        }
    }

    /**
     * Eliminar usuario
     *
     * Elimina permanentemente un usuario del sistema junto con sus roles,
     * permisos y tokens de sesión. No se puede eliminar al usuario autenticado.
     *
     * @group Usuarios
     *
     * @urlParam id integer required ID del usuario a eliminar. Example: 5
     *
     * @response 200 scenario="Usuario eliminado" {
     *   "success": true,
     *   "message": "Usuario eliminado exitosamente",
     *   "data": []
     * }
     * @response 403 scenario="Intento de eliminar cuenta propia" {
     *   "success": false,
     *   "message": "No puedes eliminar tu propia cuenta",
     *   "errors": ""
     * }
     * @response 404 scenario="Usuario no encontrado" {
     *   "success": false,
     *   "message": "El usuario no fue encontrado",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            // No permitir eliminar al usuario autenticado
            if ($request->user() && $request->user()->id == $user->id) {
                return $this->errorResponse(__('messages.user.delete_own_forbidden'), "", 403);
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

            return $this->successResponse([], __('messages.user.deleted'), 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(__('messages.user.not_found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("users", "Error deleting user", $id, $th);
            return $this->errorResponse(__('messages.user.delete_error'), "", 500);
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
     * Activar usuario
     *
     * Activa un usuario que se encontraba inactivo, permitiéndole iniciar sesión nuevamente.
     *
     * @group Usuarios
     *
     * @urlParam user integer required ID del usuario a activar. Example: 3
     *
     * @response 200 scenario="Usuario activado" {
     *   "success": true,
     *   "message": "Usuario activado exitosamente",
     *   "data": []
     * }
     * @response 404 scenario="Usuario no encontrado" {
     *   "success": false,
     *   "message": "Registro no encontrado",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function activate(Request $request, $id)
    {
        try {
            $row = User::where('id', $id)->first();
            if (!$row) {
                return $this->errorResponse(__('messages.general.record_not_found'), "", 404);
            }

            $row->active = true;
            $row->save();

            return $this->successResponse([], __('messages.user.activated'), 200);

        } catch (\Throwable $th) {
            $this->createLog("users", "Error activating user", $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }

    /**
     * Desactivar usuario
     *
     * Desactiva un usuario impidiéndole iniciar sesión. Los datos no se eliminan.
     *
     * @group Usuarios
     *
     * @urlParam user integer required ID del usuario a desactivar. Example: 3
     *
     * @response 200 scenario="Usuario desactivado" {
     *   "success": true,
     *   "message": "Usuario desactivado exitosamente",
     *   "data": []
     * }
     * @response 404 scenario="Usuario no encontrado" {
     *   "success": false,
     *   "message": "Registro no encontrado",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function deactivate(Request $request, $id)
    {
        try {
            $row = User::where('id', $id)->first();
            if (!$row) {
                return $this->errorResponse(__('messages.general.record_not_found'), "", 404);
            }

            $row->active = false;
            $row->save();

            return $this->successResponse([], __('messages.user.deactivated'), 200);

        } catch (\Throwable $th) {
            $this->createLog("users", "Error deactivating user", $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }

    /**
     * Historial de actividad del usuario
     *
     * Retorna el historial de cambios y actividad registrada del usuario especificado.
     * Incluye todos los eventos auditados (creación, modificación, etc.).
     *
     * @group Usuarios
     *
     * @urlParam user integer required ID del usuario. Example: 1
     *
     * @response 200 scenario="Historial obtenido" {
     *   "success": true,
     *   "message": "Historial obtenido exitosamente",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "Juan Pérez",
     *       "email": "usuario@ejemplo.com"
     *     },
     *     "logs": [
     *       {
     *         "id": 10,
     *         "table": "users",
     *         "type": "UPDATE OF THE REGISTRY",
     *         "id_item": 1,
     *         "reason": "User information updated",
     *         "created_at": "2025-03-01T12:00:00.000000Z"
     *       }
     *     ]
     *   }
     * }
     * @response 404 scenario="Usuario no encontrado" {
     *   "success": false,
     *   "message": "El usuario no fue encontrado",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
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
                ], __('messages.user.history_success'), 200);
            }
        } catch (\Throwable $th) {
            $this->createLog("users", "Error retrieving user history", $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }
    /**
     * Actualizar idioma del usuario
     *
     * Actualiza la preferencia de idioma del usuario especificado.
     *
     * @group Usuarios
     *
     * @urlParam user integer required ID del usuario. Example: 1
     *
     * @bodyParam lang string required Código de idioma (es|en). Example: en
     *
     * @response 200 scenario="Idioma actualizado" {
     *   "success": true,
     *   "message": "Idioma actualizado exitosamente",
     *   "data": {
     *     "lang": "en"
     *   }
     * }
     * @response 404 scenario="Usuario no encontrado" {
     *   "success": false,
     *   "message": "El usuario no fue encontrado",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function language(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            // actualizar lenguaje
            $user->lang = $request->input('lang');
            $user->save();
            return $this->successResponse(['lang' => $user->lang], __('messages.user.language_updated'), 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(__('messages.user.not_found'), "", 404);
        } catch (\Throwable $th) {
            $this->createLog("users", "Error retrieving user language", $id, $th);
            return $this->errorResponse(__('messages.general.error_retry'), "", 500);
        }
    }
}

