# 📚 Documentación Técnica — Finanzas App Backend

## Índice

1. [Autenticación](#autenticación)
2. [Usuarios](#usuarios)
3. [Roles y Permisos](#roles-y-permisos)
4. [Menús](#menús)
5. [Sistema de Logs](#sistema-de-logs)
6. [Traits Globales](#traits-globales)
7. [Helpers](#helpers)
8. [Sistema de Encriptación](#sistema-de-encriptación)
9. [Colas de Trabajo](#colas-de-trabajo)
10. [WebSockets](#websockets)

---

## Autenticación

**Mecanismo:** Laravel Sanctum (Bearer Token)

### Endpoints

| Método | Ruta | Descripción |
|--------|------|-------------|
| POST | `/api/login` | Iniciar sesión, retorna token |
| POST | `/api/logout` | Cerrar sesión, revoca token |
| GET | `/api/me` | Datos del usuario autenticado |

### Flujo de autenticación

```
1. POST /api/login con {email, password}
2. Respuesta: { data: { token: "1|abc..." } }
3. Usar: Authorization: Bearer 1|abc...
4. POST /api/logout para revocar
```

### Configuración

- Tokens guardados en tabla `personal_access_tokens`
- Configuración en `config/sanctum.php`
- Middleware: `auth:sanctum`

---

## Usuarios

### Modelo: `App\Models\User`

**Traits:** `HasApiTokens`, `HasFactory`, `Notifiable`, `HasRoles`, `EncryptableTrait`

**Campos encriptados:** `document`, `first_name`, `second_name`, `first_last_name`, `second_last_name`, `address`

**Campos públicos:** `email`, `phone`, `phone_ext`, `birth_day`, `lang`, `active`, `imagen`

### Endpoints

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/api/user` | Listar usuarios (paginado, buscable) |
| POST | `/api/user` | Crear usuario |
| GET | `/api/user/{id}` | Ver usuario |
| PUT | `/api/user/{id}` | Actualizar usuario |
| DELETE | `/api/user/{id}` | Eliminar usuario |
| POST | `/api/user/{id}/activate` | Activar usuario |
| POST | `/api/user/{id}/deactivate` | Desactivar usuario |
| GET | `/api/user/{id}/history` | Historial de actividad |
| POST | `/api/user/{id}/language` | Cambiar idioma |

### Paginación

```
GET /api/user?take=10&skip=0&search=juan
```

Parámetros:
- `take` — Registros por página (máx 100, default 10)
- `skip` — Registros a saltar (offset)
- `search` — Búsqueda en nombre, email, documento, teléfono

---

## Roles y Permisos

**Librería:** Spatie Laravel Permission 7.3

### Endpoints

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/api/roles` | Listar todos los roles |
| GET | `/api/roles/{id}` | Ver rol específico |
| GET | `/api/permissions` | Listar todos los permisos |

### Permisos disponibles

Los permisos se configuran en `config/permission_list.php`.

### Asignar roles al crear usuario

```json
POST /api/user
{
    "email": "user@example.com",
    "password": "secret",
    "roles": ["admin", "user"]
}
```

---

## Menús

### Modelo: `App\Models\Menu`

**Relaciones:**
- `parentMenu()` — BelongsTo (padre)
- `subMenus()` — HasMany (hijos ordenados por `order`)

**Scopes:**
- `rootMenus()` — Solo menús sin padre
- `visible()` — Solo menús con `flag_visible = true`

### Endpoints

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/api/menu` | Listar menús paginados |
| POST | `/api/menu` | Crear menú |
| GET | `/api/menu/{id}` | Ver menú |
| PUT | `/api/menu/{id}` | Actualizar menú |
| DELETE | `/api/menu/{id}` | Eliminar menú |
| GET | `/api/menu/hierarchical` | Árbol jerárquico completo |
| GET | `/api/menu/by-system/{id}` | Menús por sistema |

### Estructura jerárquica

```json
GET /api/menu/hierarchical
{
    "data": [
        {
            "id": 1,
            "label": "Dashboard",
            "link": "/dashboard",
            "icon": "home",
            "children": [
                {
                    "id": 5,
                    "label": "Resumen",
                    "link": "/dashboard/summary"
                }
            ]
        }
    ]
}
```

---

## Sistema de Logs

### Modelos

| Modelo | Tabla | Propósito |
|--------|-------|-----------|
| `Logs` | `logs` | Operaciones CRUD sobre cualquier tabla |
| `ErrorException` | `error_exceptions` | Stack trace de excepciones |
| `LogsInformation` | `logs_information` | Metadata adicional de logs |

### Uso con LogTrait

```php
use App\Traits\LogTrait;

class TransactionController extends Controller
{
    use LogTrait;

    public function store(): JsonResponse
    {
        // ... crear transacción
        $this->createLog('transactions', 'CREATE', $transaction->id);
    }
}
```

### Tipos de log

- `CREATE` — Creación de registro
- `UPDATE` — Actualización de registro
- `DELETE` — Eliminación de registro
- `VIEW` — Consulta importante
- Error: Si se pasa `$th` (Throwable), guarda también en `error_exceptions`

---

## Traits Globales

### `ApiResponse` — `app/Traits/ApiResponse.php`

```php
// Éxito (200)
$this->successResponse($data, 'Mensaje', 200);

// Éxito con paginación
$this->successResponse($data, 'Lista obtenida', 200, [
    'total' => 150,
    'per_page' => 10,
    'current_page' => 1
]);

// Error
$this->errorResponse('Mensaje de error', $errorsArray, 422);

// Error de validación
$this->infoResponse($validationMessages, $errors);
```

### `LogTrait` — `app/Traits/LogTrait.php`

```php
$this->createLog($tabla, $tipo, $id, $excepcion = "", $razon = "");
$this->set_language($language, $tipo, $tabla, $id);
```

### `EncryptableTrait` — `app/Traits/EncryptableTrait.php`

```php
// En el modelo, definir campos a encriptar:
protected $encryptable = ['document', 'first_name', 'address'];

// El trait encripta automáticamente al guardar y desencripta al leer
// Usa funciones SQL: encrypt_data() y decrypt_data()
```

---

## Helpers

Archivo: `app/Helpers/Helpers.php` (autoload global)

```php
// Limpiar formato de moneda COP → número
cleanNumber("$ 1.250.000")  // → 1250000.0
cleanNumber("1.250.000")    // → 1250000.0

// Número → formato COP
transformNumber(1250000)    // → "$ 1.250.000"
transformNumber(500)        // → "$ 500"
```

---

## Sistema de Encriptación

Se usan funciones a nivel de base de datos MySQL:

- `encrypt_data(valor, llave)` — Encripta el valor
- `decrypt_data(valor, llave)` — Desencripta el valor

La clave de encriptación viene de la variable de entorno `APP_KEY`.

El `EncryptableTrait` maneja esto transparentemente: los campos listados en `$encryptable` se encriptan al guardar y desencriptan al leer automáticamente.

---

## Colas de Trabajo

Ver guía completa en [QUEUE_SETUP.md](QUEUE_SETUP.md).

### Usos en la app de finanzas

| Job | Cuándo |
|-----|--------|
| `GenerateFinancialReport` | Al pedir reporte PDF/Excel |
| `ExportTransactionsCsv` | Al exportar transacciones |
| `ImportTransactionsCsv` | Al importar transacciones |
| `SendBudgetAlertEmail` | Al exceder un presupuesto |

### Iniciar el worker

```bash
php artisan queue:work --tries=3 --timeout=300
```

---

## WebSockets

Ver guía completa en [LARAVEL_REVERB_SETUP.md](LARAVEL_REVERB_SETUP.md).

### Canales de la app de finanzas

| Canal | Tipo | Eventos |
|-------|------|---------|
| `user.{id}` | Private | `budget.exceeded`, `balance.updated`, `report.ready` |

### Iniciar Reverb

```bash
php artisan reverb:start
```
