# 📊 Diagrama de Flujo - API de Usuarios

## Flujo General de Requests

```
┌─────────────────────────────────────────────────────────────────┐
│                      Cliente HTTP (Postman/cURL)                │
└─────────────────────────────────────────────────────────────────┘
                                │
                                ↓
┌─────────────────────────────────────────────────────────────────┐
│                        Envía Request                             │
│                   + Header: Authorization                        │
│                   + Body: JSON (si POST/PUT)                    │
└─────────────────────────────────────────────────────────────────┘
                                │
                                ↓
┌─────────────────────────────────────────────────────────────────┐
│                      routes/api.php                              │
│              (Valida que tenga token válido)                    │
│                  Middleware: auth:sanctum                       │
└─────────────────────────────────────────────────────────────────┘
                                │
                                ↓
┌─────────────────────────────────────────────────────────────────┐
│                  UserController.php                              │
│         ┌─────────────────────────────────────┐                │
│         │ Selecciona método según HTTP verb: │                │
│         │ - GET /user → index()               │                │
│         │ - POST /user → store()              │                │
│         │ - GET /user/{id} → show()           │                │
│         │ - PUT /user/{id} → update()         │                │
│         │ - DELETE /user/{id} → destroy()     │                │
│         └─────────────────────────────────────┘                │
└─────────────────────────────────────────────────────────────────┘
                                │
                                ↓
        ┌───────────────────────┼───────────────────────┐
        │                       │                       │
        ↓                       ↓                       ↓
    POST/PUT        GET (listar/obtener)         DELETE
        │                       │                       │
        ↓                       ↓                       ↓
   ┌─────────┐           ┌──────────┐           ┌──────────┐
   │Request  │           │  Construir│           │ Validar  │
   │Validation           │  Query    │           │Propietario
   │          │           │  con      │           │          │
   │-Mensaje  │           │ Búsqueda │           │- No puede│
   │ en español           │- Paginación         │ ser autor
   │          │           │          │           │          │
   └─────────┘           └──────────┘           └──────────┘
        │                       │                       │
        ↓                       ↓                       ↓
   ┌─────────────────────────────────────────────────────────┐
   │            Base de Datos (Operación)                    │
   │                                                         │
   │  - INSERT (CREATE)                                     │
   │  - SELECT (READ)                                       │
   │  - UPDATE (UPDATE)                                     │
   │  - DELETE (DELETE)                                     │
   └─────────────────────────────────────────────────────────┘
        │
        ↓
   ┌──────────────────────────────────────┐
   │  Spatie Permission Management        │
   │                                      │
   │  - assignRole()                      │
   │  - syncRoles()                       │
   │  - syncPermissions()                 │
   └──────────────────────────────────────┘
        │
        ↓
   ┌──────────────────────────────────────┐
   │      Logging (LogTrait)              │
   │                                      │
   │  - createLog()                       │
   │  - Tabla: logs                       │
   │  - Tabla: error_exceptions (errors)  │
   └──────────────────────────────────────┘
        │
        ↓
   ┌──────────────────────────────────────┐
   │   buildUserResponse() - Formato      │
   │                                      │
   │   - id, name, email, document...     │
   │   - roles, permissions               │
   │   - timestamps                       │
   └──────────────────────────────────────┘
        │
        ↓
   ┌──────────────────────────────────────┐
   │   ApiResponse Trait (Response Format)│
   │                                      │
   │   ✅ successResponse()               │
   │      - success: true                 │
   │      - message: Mensaje              │
   │      - data: { datos }               │
   │                                      │
   │   ❌ errorResponse()                 │
   │      - success: false                │
   │      - message: Error                │
   │      - errors: { validaciones }      │
   └──────────────────────────────────────┘
        │
        ↓
   ┌──────────────────────────────────────┐
   │      HTTP Response JSON              │
   │      200/201/400/404/500             │
   └──────────────────────────────────────┘
        │
        ↓
   Cliente recibe respuesta
```

---

## Flujo Específico: CREAR USUARIO

```
POST /api/user
├─ Headers: Authorization: Bearer TOKEN
└─ Body: { name, email, password, ..., id_rol }
    │
    ↓
Validar token (auth:sanctum)
    │
    ↓
StoreUserRequest::validated()
├─ Valida name (requerido, max 255)
├─ Valida email (requerido, unique, email)
├─ Valida password (requerido, 8+ chars, confirmed)
├─ Valida otros campos
├─ Valida id_rol (requerido, existe en roles)
└─ Si hay error → Response 422 con errores
    │
    ↓
User::create($validated)
├─ Inserta en tabla users
├─ Encripta campos especificados
├─ Hashea contraseña automáticamente
└─ Retorna objeto User creado
    │
    ↓
Obtener rol de Spatie
├─ Role::find($idRol)
├─ Si no existe → Eliminar usuario creado
└─ Si existe → Continuar
    │
    ↓
$user->assignRole($role)
├─ Crea registro en model_has_roles
└─ Asigna rol al usuario
    │
    ↓
$user->syncPermissions($role->permissions)
├─ Obtiene permisos del rol
├─ Crea registros en model_has_permissions
└─ Sincroniza permisos con rol
    │
    ↓
$this->createLog()
├─ Inserta en tabla logs
│  ├─ table: "users"
│  ├─ operation: "CREATION OF THE REGISTRY"
│  ├─ user_id: Usuario autenticado
│  └─ reason: "Role: {role_name}"
└─ Sin error (type: 0)
    │
    ↓
buildUserResponse($user)
├─ Formatea datos del usuario
├─ Incluye roles
├─ Incluye permissions
└─ Retorna array con todos los datos
    │
    ↓
successResponse($data)
├─ success: true
├─ message: "User created successfully"
├─ data: { user: {...} }
└─ HTTP 201 Created
    │
    ↓
✅ Usuario creado exitosamente con rol y permisos sincronizados
```

---

## Flujo Específico: LISTAR USUARIOS

```
GET /api/user?take=10&skip=0&search=john
├─ Headers: Authorization: Bearer TOKEN
└─ Query Params: take, skip, search
    │
    ↓
Validar token (auth:sanctum)
    │
    ↓
Obtener parámetros
├─ take = request('take', 10)
├─ skip = request('skip', 0)
├─ search = request('search', '')
└─ Validar: take max 100, skip >= 0
    │
    ↓
Construir Query
├─ User::query()
├─ Si search existe:
│  └─ where name OR email OR document OR phone like '%search%'
└─ Obtener total count
    │
    ↓
Aplicar Paginación
├─ skip($skip)
├─ take($take)
└─ get()
    │
    ↓
Cargar relaciones
├─ with('roles:id,name')
└─ Mapear cada usuario
    │
    ↓
Para cada usuario:
├─ Datos básicos
├─ roles->pluck('name')
├─ getAllPermissions()->pluck('name')
└─ Arreglo completamente populado
    │
    ↓
Construir respuesta de paginación
├─ total: Count total
├─ take: Registros por página
├─ skip: Offset
├─ pages: ceil(total/take)
└─ current_page: floor(skip/take) + 1
    │
    ↓
successResponse($data)
├─ users: [ {...}, {...}, ... ]
├─ pagination: { total, take, skip, pages, current_page }
└─ HTTP 200 OK
    │
    ↓
✅ Lista de usuarios con información de paginación
```

---

## Flujo Específico: ACTUALIZAR USUARIO

```
PUT /api/user/1
├─ Headers: Authorization: Bearer TOKEN
├─ Body: { name, email, id_rol, ... } (parcial)
└─ Param: {user} = 1 (ID del usuario)
    │
    ↓
Validar token (auth:sanctum)
    │
    ↓
UpdateUserRequest::validated()
├─ Todos los campos optional (sometimes)
├─ Email/Document únicos excepto para este usuario
├─ Valida id_rol si se envía
└─ Si hay error → Response 422
    │
    ↓
User::findOrFail($id)
├─ Si no existe → Response 404
└─ Si existe → Obtener objeto
    │
    ↓
Guardar datos antiguos
└─ $oldData = $user->toArray()
    │
    ↓
Extraer id_rol si existe
├─ $idRol = $validated['id_rol'] ?? null
└─ unset($validated['id_rol'])
    │
    ↓
Manejo de Contraseña
├─ Si password viene vacío → unset(password)
└─ Si tiene valor → se hashea automáticamente
    │
    ↓
$user->update($validated)
├─ Actualiza campos
├─ Encripta campos especificados
└─ Retorna usuario actualizado
    │
    ↓
Si se envió id_rol:
├─ Obtener rol: Role::find($idRol)
├─ Validar que exista
├─ $user->syncRoles($role)
│  └─ Reemplaza roles previos
├─ $user->syncPermissions($permissions)
│  └─ Sincroniza permisos del nuevo rol
└─ Registrar cambio
    │
    ↓
$this->createLog()
├─ Inserta en tabla logs
│  ├─ table: "users"
│  ├─ operation: "UPDATE OF THE REGISTRY"
│  ├─ user_id: Usuario autenticado
│  └─ reason: "Role updated from..." o "User information updated"
└─ Sin error
    │
    ↓
buildUserResponse($user)
├─ Devuelve datos actualizados
├─ Incluye nuevos roles y permisos
└─ Con timestamps actualizados
    │
    ↓
successResponse($data)
├─ success: true
├─ message: "User updated successfully"
├─ data: { user: {...} }
└─ HTTP 200 OK
    │
    ↓
✅ Usuario actualizado, rol y permisos sincronizados
```

---

## Flujo Específico: ELIMINAR USUARIO

```
DELETE /api/user/1
├─ Headers: Authorization: Bearer TOKEN
└─ Param: {user} = 1 (ID del usuario a eliminar)
    │
    ↓
Validar token (auth:sanctum)
    │
    ↓
User::findOrFail($id)
├─ Si no existe → Response 404
└─ Si existe → Obtener objeto
    │
    ↓
Validar Propietario
├─ ¿Es el usuario autenticado?
├─ Si SÍ → Response 403 "Cannot delete own user"
└─ Si NO → Continuar
    │
    ↓
Registrar en logs ANTES de eliminar
├─ $this->createLog()
│  ├─ table: "users"
│  ├─ operation: "DELETION OF THE REGISTRY"
│  ├─ reason: "User: {name}"
│  └─ user_id: Usuario autenticado
    │
    ↓
Limpiar relaciones
├─ $user->syncRoles([])
│  └─ Elimina todos los roles
├─ $user->syncPermissions([])
│  └─ Elimina todos los permisos
└─ $user->tokens()->delete()
   └─ Revoca todos los tokens activos
    │
    ↓
$user->delete()
├─ Elimina registro de tabla users
└─ Retorna true
    │
    ↓
successResponse([])
├─ success: true
├─ message: "User deleted successfully"
├─ data: []
└─ HTTP 200 OK
    │
    ↓
✅ Usuario eliminado completamente
```

---

## Estructura de Logs

```
Tabla: logs
┌────────────────────────────────────────┐
│ id         │ 1                          │
│ table      │ "users"                    │
│ id_item    │ 5 (ID del usuario)         │
│ operation  │ "CREATION OF THE REGISTRY" │
│ reason     │ "Role: admin"              │
│ user       │ 1 (usuario autenticado)    │
│ date       │ "2025-11-22 14:30:00"      │
│ type       │ 0 (sin error)              │
└────────────────────────────────────────┘

Tabla: error_exceptions (solo si hay error)
┌────────────────────────────────────────────┐
│ id         │ 1                              │
│ id_log     │ 2 (ID del log con error)       │
│ type       │ ""                             │
│ message    │ "Exception message..."         │
│ params     │ "{\"json\":\"request data\"}"  │
│ endpoint   │ "api/user"                     │
│ result     │ "1"                            │
└────────────────────────────────────────────┘
```

---

## Estructura de Respuestas

```
✅ Éxito (200/201)
{
  "success": true,
  "message": "User created successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John",
      "email": "john@example.com",
      ...
      "roles": ["admin"],
      "permissions": ["create-post"]
    }
  }
}

❌ Error Validación (422)
{
  "success": false,
  "message": "El correo ya existe en el sistema",
  "errors": {
    "email": ["El correo ya existe en el sistema"]
  }
}

❌ Error No Encontrado (404)
{
  "success": false,
  "message": "User not found",
  "errors": ""
}

❌ Error Servidor (500)
{
  "success": false,
  "message": "There was an error, try again",
  "errors": ""
}
```

---

## Diagrama de Entidades

```
┌─────────────────────┐         ┌──────────────────┐
│     users           │         │     roles        │
├─────────────────────┤         ├──────────────────┤
│ id (PK)             │    1:M  │ id (PK)          │
│ name                │◄────────│ name             │
│ email               │         │ guard_name       │
│ password            │         │ created_at       │
│ document            │         │ updated_at       │
│ phone               │         └──────────────────┘
│ active              │                │
│ ... otros campos    │                │1:M
│ created_at          │                │
│ updated_at          │         ┌──────────────────┐
└─────────────────────┘         │  permissions     │
         │                      ├──────────────────┤
         │                      │ id (PK)          │
         │ 1:M                  │ name             │
         │                      │ guard_name       │
         │            ┌─────────│ created_at       │
         │            │         │ updated_at       │
         │            │         └──────────────────┘
         │            │
         │     ┌──────┴──────┐
         │     │             │
         ↓     ↓             ↓
      model_has_roles   model_has_permissions
         │                   │
         └─────────┬─────────┘
                   │
            (Tablas de relación
             Spatie Permission)
```

---

**Diagrama creado:** 22 de noviembre de 2025
**Versión:** 1.0.0
