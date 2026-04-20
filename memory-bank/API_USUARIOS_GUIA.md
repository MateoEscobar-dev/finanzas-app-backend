# API de Usuarios - Guía de Uso

## Endpoints Disponibles

### 1. Listar Usuarios (GET /api/user)

**URL:**
```
GET http://paneladmin.local/api/user?take=10&skip=0&search=john
```

**Parámetros Query:**
- `take` (int, default: 10) - Cantidad de registros a devolver (máximo 100)
- `skip` (int, default: 0) - Registros a saltar (offset)
- `search` (string, opcional) - Buscar por nombre, email, documento o teléfono

**Headers:**
```
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "Users retrieved successfully",
  "data": {
    "users": [
      {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "document": "123456789",
        "first_name": "John",
        "second_name": "David",
        "first_last_name": "Doe",
        "second_last_name": "Smith",
        "address": "123 Main St",
        "phone": "5551234567",
        "phone_ext": "101",
        "birth_day": "1990-05-15",
        "lang": "es",
        "active": 1,
        "imagen": "path/to/image.jpg",
        "email_verified_at": "2025-11-22T10:00:00Z",
        "created_at": "2025-11-22T08:30:00Z",
        "updated_at": "2025-11-22T08:30:00Z",
        "roles": ["admin", "editor"],
        "permissions": ["create-post", "edit-post", "delete-post"]
      }
    ],
    "pagination": {
      "total": 50,
      "take": 10,
      "skip": 0,
      "pages": 5,
      "current_page": 1
    }
  }
}
```

---

### 2. Crear Usuario (POST /api/user)

**URL:**
```
POST http://paneladmin.local/api/user
```

**Headers:**
```
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

**Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "document": "123456789",
  "first_name": "John",
  "second_name": "David",
  "first_last_name": "Doe",
  "second_last_name": "Smith",
  "address": "123 Main St",
  "phone": "5551234567",
  "phone_ext": "101",
  "birth_day": "1990-05-15",
  "lang": "es",
  "active": 1,
  "imagen": "path/to/image.jpg",
  "id_rol": 2
}
```

**Respuesta exitosa (201):**
```json
{
  "success": true,
  "message": "User created successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "document": "123456789",
      "first_name": "John",
      "second_name": "David",
      "first_last_name": "Doe",
      "second_last_name": "Smith",
      "address": "123 Main St",
      "phone": "5551234567",
      "phone_ext": "101",
      "birth_day": "1990-05-15",
      "lang": "es",
      "active": 1,
      "imagen": "path/to/image.jpg",
      "email_verified_at": null,
      "created_at": "2025-11-22T10:00:00Z",
      "updated_at": "2025-11-22T10:00:00Z",
      "roles": ["editor"],
      "permissions": ["edit-post", "view-post"]
    }
  }
}
```

**Errores comunes:**
```json
// Email duplicado
{
  "success": false,
  "message": "El correo ya existe en el sistema",
  "errors": {
    "email": ["El correo ya existe en el sistema"]
  }
}

// Rol no existe
{
  "success": false,
  "message": "The selected role does not exist",
  "errors": "The selected role does not exist"
}

// Contraseña no confirmada
{
  "success": false,
  "message": "La confirmación de contraseña no coincide",
  "errors": {
    "password": ["La confirmación de contraseña no coincide"]
  }
}
```

---

### 3. Obtener Usuario Específico (GET /api/user/{id})

**URL:**
```
GET http://paneladmin.local/api/user/1
```

**Headers:**
```
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "User retrieved successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "document": "123456789",
      "first_name": "John",
      "second_name": "David",
      "first_last_name": "Doe",
      "second_last_name": "Smith",
      "address": "123 Main St",
      "phone": "5551234567",
      "phone_ext": "101",
      "birth_day": "1990-05-15",
      "lang": "es",
      "active": 1,
      "imagen": "path/to/image.jpg",
      "email_verified_at": "2025-11-22T10:00:00Z",
      "created_at": "2025-11-22T08:30:00Z",
      "updated_at": "2025-11-22T08:30:00Z",
      "roles": ["admin"],
      "permissions": ["create-post", "edit-post", "delete-post"]
    }
  }
}
```

**Error 404:**
```json
{
  "success": false,
  "message": "User not found",
  "errors": ""
}
```

---

### 4. Actualizar Usuario (PUT /api/user/{id})

**URL:**
```
PUT http://paneladmin.local/api/user/1
```

**Headers:**
```
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

**Body (todos los campos son opcionales):**
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "newpassword123",
  "password_confirmation": "newpassword123",
  "first_name": "Jane",
  "phone": "5559876543",
  "active": 1,
  "id_rol": 3
}
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "User updated successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "Jane Doe",
      "email": "jane@example.com",
      "document": "123456789",
      "first_name": "Jane",
      "second_name": "David",
      "first_last_name": "Doe",
      "second_last_name": "Smith",
      "address": "123 Main St",
      "phone": "5559876543",
      "phone_ext": "101",
      "birth_day": "1990-05-15",
      "lang": "es",
      "active": 1,
      "imagen": "path/to/image.jpg",
      "email_verified_at": "2025-11-22T10:00:00Z",
      "created_at": "2025-11-22T08:30:00Z",
      "updated_at": "2025-11-22T11:00:00Z",
      "roles": ["moderator"],
      "permissions": ["edit-post", "view-post"]
    }
  }
}
```

**Notas importantes:**
- Si `password` se envía vacío, no se actualiza
- Si se envía `id_rol`, se sincronizarán automáticamente los permisos del nuevo rol
- Solo se actualizan los campos enviados (PATCH-like behavior)

---

### 5. Eliminar Usuario (DELETE /api/user/{id})

**URL:**
```
DELETE http://paneladmin.local/api/user/1
```

**Headers:**
```
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "User deleted successfully",
  "data": []
}
```

**Errores:**
```json
// Intentar eliminarse a sí mismo
{
  "success": false,
  "message": "You cannot delete your own user",
  "errors": ""
}

// Usuario no encontrado
{
  "success": false,
  "message": "User not found",
  "errors": ""
}
```

---

## Registros de Log Automáticos

El sistema registra automáticamente en la tabla `logs` las siguientes operaciones:

### Creación de Usuario
```
table: "users"
operation: "CREATION OF THE REGISTRY"
reason: "Role: admin"
```

### Actualización de Usuario
```
table: "users"
operation: "UPDATE OF THE REGISTRY"
reason: "Role updated from previous role to: moderator"
```

### Eliminación de Usuario
```
table: "users"
operation: "DELETION OF THE REGISTRY"
reason: "User: John Doe"
```

### En caso de error
Se crea un registro en `error_exceptions` con:
- `id_log`: ID del log
- `type`: Tipo de error
- `message`: Mensaje del error
- `params`: Parámetros enviados en JSON
- `endpoint`: Ruta del endpoint
- `result`: Estado del resultado

---

## Características Principales

✅ **Paginación personalizable** - `take` y `skip`
✅ **Búsqueda integrada** - Buscar en nombre, email, documento, teléfono
✅ **Gestión de roles con Spatie** - Asignación automática de permisos
✅ **Sincronización de permisos** - Al crear o actualizar, sincroniza con el rol
✅ **Validaciones completas** - Reglas de validación robustas en StoreUserRequest y UpdateUserRequest
✅ **Logs automáticos** - Registro de todas las operaciones usando LogTrait
✅ **Manejo de errores** - Respuestas consistentes y descriptivas
✅ **Encriptación** - Los campos especificados en el modelo se encriptan automáticamente

---

## Validaciones

### StoreUserRequest (Crear Usuario)
- `name` - Requerido, máx 255 caracteres
- `email` - Requerido, formato email válido, único en BD
- `password` - Requerido, mínimo 8 caracteres, debe estar confirmado
- `document` - Opcional, máx 255 caracteres, único en BD
- `first_name`, `second_name`, `first_last_name`, `second_last_name` - Opcional, máx 255 caracteres
- `address` - Opcional, máx 255 caracteres
- `phone` - Opcional, máx 20 caracteres
- `phone_ext` - Opcional, máx 10 caracteres
- `birth_day` - Opcional, formato date válido
- `lang` - Opcional, máx 80 caracteres
- `active` - Requerido, tipo boolean
- `imagen` - Opcional, máx 255 caracteres
- `id_rol` - Requerido, debe existir en tabla `roles`

### UpdateUserRequest (Actualizar Usuario)
- Mismas validaciones que StoreUserRequest pero:
  - Todos los campos son opcionales (`sometimes`)
  - `email` permite el email del usuario actual
  - `document` permite el documento del usuario actual
  - `password` es opcional (no se actualiza si está vacío)

---

## Códigos HTTP

- `200 OK` - Operación exitosa
- `201 Created` - Usuario creado exitosamente
- `400 Bad Request` - Validación fallida
- `403 Forbidden` - No permitido (ej: eliminar propio usuario)
- `404 Not Found` - Usuario no encontrado
- `500 Internal Server Error` - Error del servidor
