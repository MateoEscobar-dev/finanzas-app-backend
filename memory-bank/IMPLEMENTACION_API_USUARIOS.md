# Implementación de API de Usuarios - Resumen de Cambios

## 📋 Archivos Creados

### 1. **UserController.php**
Ubicación: `app/Http/Controllers/Api/UserController.php`

**Métodos implementados:**
- `index()` - GET /api/user - Listar usuarios con paginación y búsqueda
- `store()` - POST /api/user - Crear nuevo usuario
- `show()` - GET /api/user/{id} - Obtener usuario específico
- `update()` - PUT /api/user/{id} - Actualizar usuario
- `destroy()` - DELETE /api/user/{id} - Eliminar usuario
- `buildUserResponse()` - Método privado para formatear respuesta

**Características:**
- ✅ Usa `LogTrait` y `ApiResponse` para logging y respuestas consistentes
- ✅ Validación automática con requests personalizadas
- ✅ Integración con Spatie Permissions (asignación/sincronización de roles)
- ✅ Paginación con parámetros `take` (máximo 100) y `skip`
- ✅ Búsqueda por nombre, email, documento, teléfono
- ✅ Registro automático de operaciones en logs
- ✅ Manejo robusto de excepciones

### 2. **StoreUserRequest.php**
Ubicación: `app/Http/Requests/StoreUserRequest.php`

**Validaciones:**
- Nombre: requerido, máx 255 caracteres
- Email: requerido, válido, único
- Contraseña: requerida, mínimo 8 caracteres, confirmada
- Campos adicionales: documento, nombres, apellidos, dirección, teléfono, etc.
- Rol (id_rol): requerido, debe existir en tabla roles

**Mensajes personalizados en español:**
- Validaciones claras y amigables para el usuario final

### 3. **UpdateUserRequest.php**
Ubicación: `app/Http/Requests/UpdateUserRequest.php`

**Diferencias con StoreUserRequest:**
- Todos los campos son opcionales (uso de `sometimes`)
- Email y documento pueden ser del mismo usuario (no duplicados)
- Contraseña es opcional
- Permite actualizaciones parciales

## 📝 Archivos Modificados

### 1. **routes/api.php**

**Cambios:**
```php
// Se agregó el import
use App\Http\Controllers\Api\UserController;

// Se agregaron las rutas dentro del middleware auth:sanctum
Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{user}', [UserController::class, 'show']);
Route::put('/user/{user}', [UserController::class, 'update']);
Route::delete('/user/{user}', [UserController::class, 'destroy']);
```

## 🔍 Detalles de Implementación

### Sistema de Logging

Todos los métodos registran operaciones usando `LogTrait`:

**Al crear usuario:**
```php
$this->createLog("users", "CREATION OF THE REGISTRY", $user->id, "", "Role: {$role->name}");
```

**Al actualizar usuario:**
```php
$this->createLog("users", "UPDATE OF THE REGISTRY", $user->id, "", $updateReason);
```

**Al eliminar usuario:**
```php
$this->createLog("users", "DELETION OF THE REGISTRY", $user->id, "", "User: {$user->name}");
```

**En caso de error:**
```php
$this->createLog("users", "Error creating user", 0, $th);
```

### Gestión de Roles y Permisos (Spatie)

**Al crear usuario:**
```php
$user->assignRole($role);
$permissions = $role->permissions;
$user->syncPermissions($permissions);
```

**Al actualizar usuario:**
```php
$user->syncRoles($role);  // Reemplaza roles previos
$user->syncPermissions($permissions); // Sincroniza permisos
```

**Al eliminar usuario:**
```php
$user->syncRoles([]); // Elimina todos los roles
$user->syncPermissions([]); // Elimina todos los permisos
$user->tokens()->delete(); // Revoca tokens activos
```

### Respuestas API

Todas las respuestas usan el trait `ApiResponse`:

**Éxito (201/200):**
```json
{
  "success": true,
  "message": "User created successfully",
  "data": { /* datos */ }
}
```

**Error:**
```json
{
  "success": false,
  "message": "Error message",
  "errors": { /* validations */ }
}
```

### Paginación

**Parámetros:**
- `take` - Registros por página (máx 100)
- `skip` - Registros a saltar (offset)

**Respuesta:**
```json
{
  "pagination": {
    "total": 50,
    "take": 10,
    "skip": 0,
    "pages": 5,
    "current_page": 1
  }
}
```

### Búsqueda

**Parámetro:** `search`

Busca en:
- Nombre (name)
- Email (email)
- Documento (document)
- Teléfono (phone)

## 🔐 Seguridad

✅ Todas las rutas están protegidas con `auth:sanctum`
✅ No se permite eliminar al usuario autenticado
✅ Validación de ID de rol antes de asignar
✅ Encriptación automática de campos sensibles (definidos en User model)
✅ Contraseñas hasheadas automáticamente

## 📊 Campos del Usuario

| Campo | Tipo | Encriptable | Validación |
|-------|------|------------|-----------|
| id | bigint unsigned | No | - |
| name | varchar(255) | No | Requerido |
| email | varchar(255) | No | Requerido, único |
| password | varchar(255) | No | Requerido (8+ chars) |
| document | varchar(255) | Sí | Opcional, único |
| first_name | varchar(255) | Sí | Opcional |
| second_name | varchar(255) | Sí | Opcional |
| first_last_name | varchar(255) | Sí | Opcional |
| second_last_name | varchar(255) | Sí | Opcional |
| address | varchar(255) | Sí | Opcional |
| phone | varchar(255) | No | Opcional |
| phone_ext | varchar(255) | No | Opcional |
| birth_day | date | No | Opcional |
| lang | varchar(80) | No | Opcional |
| active | tinyint | No | Requerido |
| imagen | varchar(255) | No | Opcional |
| email_verified_at | timestamp | No | - |
| created_at | timestamp | No | - |
| updated_at | timestamp | No | - |

## 🧪 Ejemplos de Uso

### Listar usuarios
```bash
curl -X GET "http://paneladmin.local/api/user?take=10&skip=0" \
  -H "Authorization: Bearer TOKEN"
```

### Crear usuario
```bash
curl -X POST "http://paneladmin.local/api/user" \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "active": 1,
    "id_rol": 2
  }'
```

### Actualizar usuario
```bash
curl -X PUT "http://paneladmin.local/api/user/1" \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Jane Doe",
    "email": "jane@example.com",
    "id_rol": 3
  }'
```

### Eliminar usuario
```bash
curl -X DELETE "http://paneladmin.local/api/user/1" \
  -H "Authorization: Bearer TOKEN"
```

## 📚 Documentación Completa

Para documentación detallada, ver: `API_USUARIOS_GUIA.md`

---

**Fecha:** 22 de noviembre de 2025
**Estado:** ✅ Completado
**Testing:** Listo para usar
