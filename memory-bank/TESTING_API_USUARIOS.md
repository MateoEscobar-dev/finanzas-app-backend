# Tests para API de Usuarios

Este archivo contiene ejemplos de requests HTTP que puedes usar en Postman o similar.

## 1. LISTAR USUARIOS

### Request
```http
GET http://paneladmin.local/api/user?take=10&skip=0 HTTP/1.1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

### Con búsqueda
```http
GET http://paneladmin.local/api/user?take=10&skip=0&search=john HTTP/1.1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

### Response esperada (200)
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
        "roles": ["admin"],
        "permissions": ["create-post", "edit-post"]
      }
    ],
    "pagination": {
      "total": 25,
      "take": 10,
      "skip": 0,
      "pages": 3,
      "current_page": 1
    }
  }
}
```

---

## 2. CREAR USUARIO

### Request
```http
POST http://paneladmin.local/api/user HTTP/1.1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "name": "Jane Smith",
  "email": "jane.smith@example.com",
  "password": "SecurePass123",
  "password_confirmation": "SecurePass123",
  "document": "987654321",
  "first_name": "Jane",
  "second_name": "Marie",
  "first_last_name": "Smith",
  "second_last_name": "Johnson",
  "address": "456 Oak Avenue",
  "phone": "5559876543",
  "phone_ext": "202",
  "birth_day": "1995-03-20",
  "lang": "es",
  "active": 1,
  "imagen": "path/to/avatar.jpg",
  "id_rol": 2
}
```

### Response esperada (201)
```json
{
  "success": true,
  "message": "User created successfully",
  "data": {
    "user": {
      "id": 5,
      "name": "Jane Smith",
      "email": "jane.smith@example.com",
      "document": "987654321",
      "first_name": "Jane",
      "second_name": "Marie",
      "first_last_name": "Smith",
      "second_last_name": "Johnson",
      "address": "456 Oak Avenue",
      "phone": "5559876543",
      "phone_ext": "202",
      "birth_day": "1995-03-20",
      "lang": "es",
      "active": 1,
      "imagen": "path/to/avatar.jpg",
      "email_verified_at": null,
      "created_at": "2025-11-22T14:30:00Z",
      "updated_at": "2025-11-22T14:30:00Z",
      "roles": ["editor"],
      "permissions": ["edit-post", "view-post"]
    }
  }
}
```

### Error: Email duplicado
```json
{
  "success": false,
  "message": "El correo ya existe en el sistema",
  "errors": {
    "email": ["El correo ya existe en el sistema"]
  }
}
```

### Error: Rol no existe
```json
{
  "success": false,
  "message": "The selected role does not exist",
  "errors": ""
}
```

### Error: Contraseña no coincide
```json
{
  "success": false,
  "message": "La confirmación de contraseña no coincide",
  "errors": {
    "password": ["La confirmación de contraseña no coincide"]
  }
}
```

---

## 3. OBTENER USUARIO ESPECÍFICO

### Request
```http
GET http://paneladmin.local/api/user/1 HTTP/1.1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

### Response esperada (200)
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

### Error: Usuario no encontrado (404)
```json
{
  "success": false,
  "message": "User not found",
  "errors": ""
}
```

---

## 4. ACTUALIZAR USUARIO

### Request - Cambiar rol
```http
PUT http://paneladmin.local/api/user/1 HTTP/1.1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "id_rol": 3
}
```

### Request - Cambiar múltiples campos
```http
PUT http://paneladmin.local/api/user/1 HTTP/1.1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "name": "John Updated",
  "email": "john.updated@example.com",
  "phone": "5551111111",
  "active": 0,
  "id_rol": 2
}
```

### Request - Cambiar contraseña
```http
PUT http://paneladmin.local/api/user/1 HTTP/1.1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "password": "NewPassword123",
  "password_confirmation": "NewPassword123"
}
```

### Response esperada (200)
```json
{
  "success": true,
  "message": "User updated successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Updated",
      "email": "john.updated@example.com",
      "document": "123456789",
      "first_name": "John",
      "second_name": "David",
      "first_last_name": "Doe",
      "second_last_name": "Smith",
      "address": "123 Main St",
      "phone": "5551111111",
      "phone_ext": "101",
      "birth_day": "1990-05-15",
      "lang": "es",
      "active": 0,
      "imagen": "path/to/image.jpg",
      "email_verified_at": "2025-11-22T10:00:00Z",
      "created_at": "2025-11-22T08:30:00Z",
      "updated_at": "2025-11-22T15:00:00Z",
      "roles": ["moderator"],
      "permissions": ["edit-post", "view-post"]
    }
  }
}
```

### Error: Rol no existe
```json
{
  "success": false,
  "message": "The selected role does not exist",
  "errors": ""
}
```

---

## 5. ELIMINAR USUARIO

### Request
```http
DELETE http://paneladmin.local/api/user/5 HTTP/1.1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

### Response esperada (200)
```json
{
  "success": true,
  "message": "User deleted successfully",
  "data": []
}
```

### Error: Intentar eliminar usuario propio
```json
{
  "success": false,
  "message": "You cannot delete your own user",
  "errors": ""
}
```

### Error: Usuario no encontrado (404)
```json
{
  "success": false,
  "message": "User not found",
  "errors": ""
}
```

---

## Script cURL para Testing Rápido

### Login (obtener token)
```bash
curl -X POST "http://paneladmin.local/api/login" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password"
  }'
```

### Listar usuarios
```bash
curl -X GET "http://paneladmin.local/api/user?take=10&skip=0" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json"
```

### Crear usuario
```bash
curl -X POST "http://paneladmin.local/api/user" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "password": "TestPass123",
    "password_confirmation": "TestPass123",
    "active": 1,
    "id_rol": 2
  }'
```

### Actualizar usuario
```bash
curl -X PUT "http://paneladmin.local/api/user/1" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Updated Name",
    "id_rol": 3
  }'
```

### Eliminar usuario
```bash
curl -X DELETE "http://paneladmin.local/api/user/5" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json"
```

---

## Postman Collection

Puedes importar esta colección en Postman:

```json
{
  "info": {
    "name": "API Usuarios",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Login",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\"email\":\"admin@example.com\",\"password\":\"password\"}"
        },
        "url": {
          "raw": "http://paneladmin.local/api/login",
          "protocol": "http",
          "host": ["paneladmin", "local"],
          "path": ["api", "login"]
        }
      }
    },
    {
      "name": "List Users",
      "request": {
        "method": "GET",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{token}}"
          }
        ],
        "url": {
          "raw": "http://paneladmin.local/api/user?take=10&skip=0",
          "protocol": "http",
          "host": ["paneladmin", "local"],
          "path": ["api", "user"],
          "query": [
            {
              "key": "take",
              "value": "10"
            },
            {
              "key": "skip",
              "value": "0"
            }
          ]
        }
      }
    },
    {
      "name": "Create User",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{token}}"
          },
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\"name\":\"New User\",\"email\":\"newuser@example.com\",\"password\":\"TestPass123\",\"password_confirmation\":\"TestPass123\",\"active\":1,\"id_rol\":2}"
        },
        "url": {
          "raw": "http://paneladmin.local/api/user",
          "protocol": "http",
          "host": ["paneladmin", "local"],
          "path": ["api", "user"]
        }
      }
    },
    {
      "name": "Get User",
      "request": {
        "method": "GET",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{token}}"
          }
        ],
        "url": {
          "raw": "http://paneladmin.local/api/user/1",
          "protocol": "http",
          "host": ["paneladmin", "local"],
          "path": ["api", "user", "1"]
        }
      }
    },
    {
      "name": "Update User",
      "request": {
        "method": "PUT",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{token}}"
          },
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\"name\":\"Updated Name\",\"id_rol\":3}"
        },
        "url": {
          "raw": "http://paneladmin.local/api/user/1",
          "protocol": "http",
          "host": ["paneladmin", "local"],
          "path": ["api", "user", "1"]
        }
      }
    },
    {
      "name": "Delete User",
      "request": {
        "method": "DELETE",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{token}}"
          }
        ],
        "url": {
          "raw": "http://paneladmin.local/api/user/5",
          "protocol": "http",
          "host": ["paneladmin", "local"],
          "path": ["api", "user", "5"]
        }
      }
    }
  ]
}
```

---

## Logs Esperados

### Cuando se crea un usuario
En tabla `logs`:
```
table: "users"
id_item: 5
operation: "CREATION OF THE REGISTRY"
reason: "Role: editor"
user: 1 (usuario autenticado)
type: 0 (sin error)
```

### Cuando se actualiza un usuario
En tabla `logs`:
```
table: "users"
id_item: 1
operation: "UPDATE OF THE REGISTRY"
reason: "Role updated from previous role to: moderator"
user: 1
type: 0
```

### Cuando se elimina un usuario
En tabla `logs`:
```
table: "users"
id_item: 5
operation: "DELETION OF THE REGISTRY"
reason: "User: Jane Smith"
user: 1
type: 0
```

### Cuando ocurre un error
En tabla `logs`:
```
table: "users"
id_item: 0
operation: "Error creating user"
type: 1 (con error)
```

En tabla `error_exceptions`:
```
id_log: [log_id]
type: ""
message: [error message]
params: {...JSON request params...}
endpoint: "api/user"
result: "1"
```

---

**Creado:** 22 de noviembre de 2025
**Última actualización:** 22 de noviembre de 2025
