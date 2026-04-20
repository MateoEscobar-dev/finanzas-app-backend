# ⚡ Quick Start - API de Usuarios

## 5 Minutos para estar listo

### Paso 1: Verificar que todo esté instalado (30 segundos)

```bash
cd /var/www/html/panel_admin/back_api_panel_admin

# Verificar archivos existen
ls -la app/Http/Controllers/Api/UserController.php
ls -la app/Http/Requests/StoreUserRequest.php
ls -la app/Http/Requests/UpdateUserRequest.php
```

### Paso 2: Limpiar caché (30 segundos)

```bash
# Limpiar rutas
php artisan route:clear

# Limpiar caché general
php artisan cache:clear

# Recargar autoload
composer dump-autoload
```

### Paso 3: Verificar rutas (30 segundos)

```bash
# Ver todas las rutas del API
php artisan route:list | grep -i user
```

Deberías ver:
```
GET|HEAD   api/user ........................... api.user.index › UserController@index
POST       api/user ........................... api.user.store › UserController@store
GET|HEAD   api/user/{user} ................... api.user.show › UserController@show
PUT        api/user/{user} ................... api.user.update › UserController@update
DELETE     api/user/{user} ................... api.user.destroy › UserController@destroy
```

### Paso 4: Obtener token de autenticación (1 minuto)

```bash
# Login
curl -X POST "http://paneladmin.local/api/login" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password"
  }'
```

Respuesta esperada:
```json
{
  "success": true,
  "data": {
    "token": "1|abc123def456...",
    "token_type": "Bearer",
    "user": { ... }
  }
}
```

**Guarda el token:** `1|abc123def456...`

### Paso 5: Prueba un endpoint (1 minuto)

```bash
# Reemplaza YOUR_TOKEN con el token obtenido arriba
curl -X GET "http://paneladmin.local/api/user?take=10&skip=0" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json"
```

✅ Si ves una lista de usuarios, ¡todo funciona!

---

## Testing Rápido en Postman

### 1. Crear Environment

1. Click en "Environments" → "+" 
2. Nombre: `API Usuarios`
3. Agregar variables:
   ```
   base_url: http://paneladmin.local
   token: (dejá vacío, se llenará después)
   ```
4. Click "Save"

### 2. Login Request

**Crear nueva request:**

```
POST {{base_url}}/api/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "password"
}
```

**En la pestaña "Tests" agregar:**

```javascript
var jsonData = pm.response.json();
pm.environment.set("token", jsonData.data.token);
```

**Click "Send"** → Se guarda el token automáticamente

### 3. List Users Request

```
GET {{base_url}}/api/user?take=10&skip=0
Authorization: Bearer {{token}}
Content-Type: application/json
```

**Click "Send"** → Deberías ver usuarios

### 4. Create User Request

```
POST {{base_url}}/api/user
Authorization: Bearer {{token}}
Content-Type: application/json

{
  "name": "New User",
  "email": "newuser@example.com",
  "password": "Password123",
  "password_confirmation": "Password123",
  "active": 1,
  "id_rol": 2
}
```

---

## Comandos Rápidos Útiles

```bash
# Ver si tabla users existe
php artisan tinker
>>> Schema::hasTable('users')
>>> exit()

# Ver si tabla roles existe
php artisan tinker
>>> Schema::hasTable('roles')
>>> exit()

# Ver roles disponibles
php artisan tinker
>>> \Spatie\Permission\Models\Role::all()
>>> exit()

# Limpiar todo y empezar
php artisan route:clear
php artisan cache:clear
php artisan config:clear
composer dump-autoload

# Ver logs de errors
tail -f storage/logs/laravel.log
```

---

## Respuestas Esperadas

### ✅ Listar Usuarios (200)
```json
{
  "success": true,
  "message": "Users retrieved successfully",
  "data": {
    "users": [ /* array de usuarios */ ],
    "pagination": {
      "total": 5,
      "take": 10,
      "skip": 0,
      "pages": 1,
      "current_page": 1
    }
  }
}
```

### ✅ Crear Usuario (201)
```json
{
  "success": true,
  "message": "User created successfully",
  "data": {
    "user": {
      "id": 6,
      "name": "New User",
      "email": "newuser@example.com",
      "roles": ["editor"],
      "permissions": ["edit-post"]
    }
  }
}
```

### ❌ Error Validación (422)
```json
{
  "success": false,
  "message": "El correo ya existe en el sistema",
  "errors": {
    "email": ["El correo ya existe en el sistema"]
  }
}
```

### ❌ No Autorizado (401)
```json
{
  "message": "Unauthorized"
}
```

---

## Problemas Comunes

### "Route not found"
```bash
php artisan route:clear
php artisan cache:clear
```

### "Unauthorized"
- ¿Copiaste el token completo?
- ¿El token está en el header correctamente?
```
Authorization: Bearer TOKEN_AQUI
```

### "User not found" (404)
- Cambia el ID a uno que exista
- Verifica en BD: `SELECT id FROM users LIMIT 5;`

### "The selected role does not exist"
- Verifica qué roles existen: `SELECT id, name FROM roles;`
- Usa un ID de rol que exista

### "Email already exists"
- Usa un email diferente
- O actualiza un usuario existente con PUT en lugar de POST

---

## Próximas Pruebas

Después del quick start, prueba:

1. ✅ **Obtener usuario específico**
   ```bash
   curl -X GET "http://paneladmin.local/api/user/1" \
     -H "Authorization: Bearer YOUR_TOKEN"
   ```

2. ✅ **Actualizar usuario**
   ```bash
   curl -X PUT "http://paneladmin.local/api/user/1" \
     -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Content-Type: application/json" \
     -d '{"name": "Updated Name"}'
   ```

3. ✅ **Buscar usuarios**
   ```bash
   curl -X GET "http://paneladmin.local/api/user?search=john" \
     -H "Authorization: Bearer YOUR_TOKEN"
   ```

4. ✅ **Cambiar rol de usuario**
   ```bash
   curl -X PUT "http://paneladmin.local/api/user/1" \
     -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Content-Type: application/json" \
     -d '{"id_rol": 3}'
   ```

5. ✅ **Eliminar usuario** (cuidado!)
   ```bash
   curl -X DELETE "http://paneladmin.local/api/user/10" \
     -H "Authorization: Bearer YOUR_TOKEN"
   ```

---

## Archivos de Referencia

| Archivo | Para qué |
|---------|----------|
| `IMPLEMENTACION_API_USUARIOS.md` | Entender lo que se hizo |
| `API_USUARIOS_GUIA.md` | Referencia completa de endpoints |
| `TESTING_API_USUARIOS.md` | Ejemplos de requests/responses |
| `TROUBLESHOOTING_API_USUARIOS.md` | Resolver problemas |
| `DIAGRAMA_API_USUARIOS.md` | Ver flujos visualmente |
| `README_API_USUARIOS.md` | Resumen general |

---

## ¿Necesitas ayuda?

1. Lee `TROUBLESHOOTING_API_USUARIOS.md`
2. Revisa logs: `tail -f storage/logs/laravel.log`
3. Usa Tinker: `php artisan tinker`
4. Verifica BD: `mysql -u user -p database`

---

**¡Ahora sí, estás listo para usar el API de usuarios! 🎉**

**Creado:** 22 de noviembre de 2025
**Versión:** 1.0.0
**Status:** ✅ Ready to Go
