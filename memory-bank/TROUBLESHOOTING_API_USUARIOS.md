# Guía de Troubleshooting - API de Usuarios

## Problemas Comunes y Soluciones

### 1. Error: "Route not found" (404)

**Síntoma:**
```
Route [user.index] not defined. (BadRouteException)
```

**Causa:** Las rutas no se han registrado correctamente

**Solución:**
1. Verifica que el archivo `routes/api.php` tenga el import de UserController:
```php
use App\Http\Controllers\Api\UserController;
```

2. Verifica que las rutas estén dentro del middleware `auth:sanctum`:
```php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    // ... otras rutas
});
```

3. Limpia la caché de rutas:
```bash
php artisan route:clear
```

4. Recarga la aplicación

---

### 2. Error: "Class not found" - UserController

**Síntoma:**
```
Class App\Http\Controllers\Api\UserController does not exist.
```

**Causa:** El archivo del controlador no existe o está en otra ubicación

**Solución:**
1. Verifica que el archivo existe en: `app/Http/Controllers/Api/UserController.php`

2. Si no existe, créalo con el contenido del documento

3. Verifica el namespace sea correcto:
```php
namespace App\Http\Controllers\Api;
```

4. Ejecuta composer dump:
```bash
composer dump-autoload
```

---

### 3. Error: "SQLSTATE[42S22]: Column not found"

**Síntoma:**
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'usuarios.document' in 'where clause'
```

**Causa:** Las migraciones no se han ejecutado o el esquema está incompleto

**Solución:**
1. Verifica que la tabla `users` tenga las columnas necesarias:
```bash
php artisan tinker
```

```php
Schema::getColumnListing('users')
```

2. Si faltan columnas, crea una migración:
```bash
php artisan make:migration add_missing_columns_to_users_table
```

3. En la migración:
```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('document')->nullable()->after('id');
        $table->string('first_name')->nullable();
        // ... agregar otros campos
    });
}
```

4. Ejecuta las migraciones:
```bash
php artisan migrate
```

---

### 4. Error: "Undefined table: roles"

**Síntoma:**
```
SQLSTATE[HY000]: General error: 1030 Got error 28 from storage engine
Undefined table: 'roles'
```

**Causa:** Las migraciones de Spatie Permission no se han instalado

**Solución:**
1. Verifica que Spatie esté instalado:
```bash
composer require spatie/laravel-permission
```

2. Publica las migraciones:
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
```

3. Ejecuta las migraciones:
```bash
php artisan migrate
```

---

### 5. Error: "Method not found" en User Model

**Síntoma:**
```
Call to undefined method App\Models\User::assignRole()
```

**Causa:** El User model no está usando el trait `HasRoles`

**Solución:**
1. Abre `app/Models/User.php`

2. Verifica que use el trait:
```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles; // ← Debe estar aquí
    // ...
}
```

3. Si no está, agrégalo

---

### 6. Error: "Undefined method 'successResponse'"

**Síntoma:**
```
Call to undefined method App\Http\Controllers\Api\UserController::successResponse()
```

**Causa:** El trait `ApiResponse` no está incluido

**Solución:**
1. Verifica que el controller use el trait:
```php
use App\Traits\ApiResponse;
use App\Traits\LogTrait;

class UserController extends Controller
{
    use ApiResponse, LogTrait; // ← Ambos deben estar
}
```

2. Si no está, agrégalo

---

### 7. Error de validación: Email duplicado pero es el mismo usuario

**Síntoma:**
```json
{
  "success": false,
  "message": "El correo ya existe en el sistema",
  "errors": {
    "email": ["El correo ya existe en el sistema"]
  }
}
```

**Causa:** Al actualizar, la validación está incluyendo al usuario actual

**Solución:**
1. Verifica que uses `UpdateUserRequest` en el método `update()`:
```php
public function update(UpdateUserRequest $request, $id)
```

2. La regla de validación debe ser:
```php
'email' => 'sometimes|required|email|unique:users,email,' . $userId,
```

3. El request debe obtener el ID correctamente:
```php
public function rules(): array
{
    $userId = $this->route('user'); // ← Importantísimo

    return [
        'email' => 'sometimes|required|email|unique:users,email,' . $userId,
        // ...
    ];
}
```

---

### 8. Error: "Unauthorized" (401)

**Síntoma:**
```json
{
  "message": "Unauthorized"
}
```

**Causa:** El token no es válido o no fue enviado

**Solución:**
1. Verifica que envíes el header:
```
Authorization: Bearer YOUR_ACTUAL_TOKEN
```

2. Obtén un token válido con login:
```bash
curl -X POST "http://paneladmin.local/api/login" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password"
  }'
```

3. Usa el token retornado en los headers

4. Si el token expiró, haz login nuevamente

---

### 9. Error: "Forbidden" (403) al eliminar usuario

**Síntoma:**
```json
{
  "success": false,
  "message": "You cannot delete your own user",
  "errors": ""
}
```

**Causa:** Intentaste eliminar el usuario con el que estás autenticado

**Solución:**
1. Usa un token de otro usuario para eliminar

2. O elimina desde la base de datos directamente (solo en desarrollo)

3. O crea otro usuario admin y usa su token

---

### 10. Error: "Role not found" al crear usuario

**Síntoma:**
```json
{
  "success": false,
  "message": "The selected role does not exist",
  "errors": ""
}
```

**Causa:** El `id_rol` enviado no existe en la tabla `roles`

**Solución:**
1. Verifica los roles disponibles:
```bash
php artisan tinker
```

```php
\Spatie\Permission\Models\Role::all()
```

2. O consulta en la BD:
```sql
SELECT id, name FROM roles;
```

3. Usa un ID de rol que exista

4. Si no hay roles, crea uno:
```php
\Spatie\Permission\Models\Role::create(['name' => 'admin']);
```

---

### 11. Los permisos no se asignan correctamente

**Síntoma:**
El usuario se crea pero los permisos no corresponden al rol

**Causa:** Problema en la sincronización de permisos

**Solución:**
1. Verifica que el rol tenga permisos asignados:
```bash
php artisan tinker
```

```php
$role = \Spatie\Permission\Models\Role::find(2);
$role->permissions;
```

2. Verifica la sincronización en el controller:
```php
$user->syncRoles($role);
$user->syncPermissions($role->permissions);
```

3. Si aún no funciona, sincroniza manualmente:
```php
$user->syncPermissions([1, 2, 3]); // IDs de permisos
```

---

### 12. Error: "Column not found: 'id_rol'"

**Síntoma:**
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'id_rol'
```

**Causa:** El campo `id_rol` no es una columna en la tabla, es una relación

**Solución:**
El `id_rol` no es una columna en la tabla `users`. Es un parámetro que usamos para:
1. Obtener el rol de Spatie
2. Asignarlo al usuario

Esto es correcto en el request, no es un campo de la BD

---

### 13. Error: "Undefined variable: $th"

**Síntoma:**
```
Undefined variable: $th
```

**Causa:** Hay un error en la lógica de logging

**Solución:**
En el método `createLog()`, el parámetro `$th` puede ser null o una excepción:

Correcto:
```php
$this->createLog("users", "CREATION OF THE REGISTRY", $user->id, "", "Role: {$role->name}");
$this->createLog("users", "Error creating user", 0, $th); // $th es la excepción
```

---

### 14. Los logs no se registran

**Síntoma:**
Las operaciones se completan pero no aparecen registros en la tabla `logs`

**Causa:** La tabla `logs` no existe o el trait no funciona correctamente

**Solución:**
1. Verifica que la tabla existe:
```bash
php artisan tinker
```

```php
Schema::hasTable('logs')
```

2. Si no existe, ejecuta las migraciones:
```bash
php artisan migrate
```

3. Verifica que el modelo `Logs` existe en `app/Models/Logs.php`

4. Verifica los permisos de BD

---

### 15. Error al actualizar: "Route model binding"

**Síntoma:**
```
Model not found
```

**Causa:** El parámetro de ruta no corresponde a un usuario existente

**Solución:**
1. Verifica que el ID del usuario sea correcto:
```bash
curl -X PUT "http://paneladmin.local/api/user/999" \
  -H "Authorization: Bearer TOKEN"
```

2. Asegúrate de que el usuario ID 999 exista en la BD

---

## Debugging

### Habilitar logs detallados

1. Abre `.env`:
```
LOG_LEVEL=debug
```

2. Recarga la aplicación

3. Revisa los logs en `storage/logs/laravel.log`

### Usar Tinker para debugging

```bash
php artisan tinker
```

```php
// Probar creación de usuario
$user = \App\Models\User::create([
    'name' => 'Test',
    'email' => 'test@example.com',
    'password' => bcrypt('password'),
    'active' => 1
]);

// Asignar rol
$role = \Spatie\Permission\Models\Role::find(2);
$user->assignRole($role);

// Verificar permisos
$user->getAllPermissions();
```

### Ver SQL queries

```php
DB::listen(function ($query) {
    echo $query->sql;
});
```

---

## Checklist de Implementación

- [ ] Archivo `UserController.php` creado en `app/Http/Controllers/Api/`
- [ ] Archivos `StoreUserRequest.php` y `UpdateUserRequest.php` creados
- [ ] Rutas actualizadas en `routes/api.php`
- [ ] `php artisan route:clear` ejecutado
- [ ] `composer dump-autoload` ejecutado
- [ ] Tabla `users` tiene todas las columnas necesarias
- [ ] Tabla `roles` existe (Spatie Permission)
- [ ] Tabla `logs` existe
- [ ] User model tiene trait `HasRoles`
- [ ] User model tiene trait `EncryptableTrait`
- [ ] UserController tiene traits `ApiResponse` y `LogTrait`
- [ ] Al menos un rol existe en BD
- [ ] Token de autenticación válido para testing

---

## Contacto y Soporte

Si encuentras otros problemas:

1. Revisa los logs: `storage/logs/laravel.log`
2. Verifica la respuesta HTTP y el estado
3. Usa Tinker para debugging manual
4. Consulta la documentación de Spatie: https://spatie.be/docs/laravel-permission/

---

**Última actualización:** 22 de noviembre de 2025
