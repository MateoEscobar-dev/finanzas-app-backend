# 👋 START HERE — Finanzas App Backend

## ¿Qué es este proyecto?

**API REST** para una aplicación de **finanzas personales gratuita** construida con Laravel 13.

Los usuarios pueden registrar sus gastos e ingresos, gestionar cuentas, crear presupuestos, seguir metas de ahorro y obtener reportes financieros.

---

## 🗺️ Navegar el memory bank

### Antes de escribir cualquier código, leer:

1. **Este archivo** — Ya lo estás leyendo ✅
2. [ARQUITECTURA-CRITERIOS-CRITICOS.md](ARQUITECTURA-CRITERIOS-CRITICOS.md) — Reglas que nunca se violan
3. [activeContext.md](activeContext.md) — ¿En qué estado está el proyecto ahora?
4. [CODING-STANDARDS.md](CODING-STANDARDS.md) — Los 15 patrones obligatorios

### Para entender la arquitectura:

→ [ARCHITECTURE.md](ARCHITECTURE.md)

### Para ver progreso y roadmap:

→ [progress.md](progress.md)

---

## ⚡ Setup del entorno en 5 pasos

```bash
# 1. Instalar dependencias
composer install

# 2. Configurar entorno
cp .env.example .env
php artisan key:generate

# 3. Configurar BD en .env
DB_DATABASE=finanzas
DB_USERNAME=root
DB_PASSWORD=secret

# 4. Migrar y sembrar
php artisan migrate
php artisan db:seed

# 5. Iniciar servidor
php artisan serve
```

---

## 🛣️ Rutas actuales

```
POST   /api/login
POST   /api/logout           [auth:sanctum]
GET    /api/me               [auth:sanctum]

GET|POST /api/user           [auth:sanctum]
GET|PUT|DELETE /api/user/{id}[auth:sanctum]

GET|POST /api/menu           [auth:sanctum]
GET|PUT|DELETE /api/menu/{id}[auth:sanctum]
GET    /api/menu/hierarchical[auth:sanctum]

GET    /api/roles            [auth:sanctum]
GET    /api/permissions      [auth:sanctum]
```

---

## 🏗️ Cuando implementes una nueva feature

### Estructura obligatoria

```
FormRequest → Controller → Service → Repository → Model
```

### Checklist mínimo antes de hacer commit

- [ ] Form Request creado para validaciones
- [ ] Policy creada para autorización (si el recurso pertenece a un usuario)
- [ ] Repository creado para acceso a datos
- [ ] Scopes en el modelo para filtros comunes
- [ ] Observer creado si el modelo necesita auditoría
- [ ] Event + Listener si hay efectos secundarios
- [ ] Job creado si hay operación pesada
- [ ] Respuestas usan `ApiResponse` trait
- [ ] Logs usan `LogTrait`

Ver checklist completo en [QUALITY-RULES.md](../QUALITY-RULES.md)

---

## 🔑 Patrones que SIEMPRE debes usar

| Patrón | Cuándo |
|--------|--------|
| `ApiResponse` trait | En todo Controller |
| `LogTrait` | Al registrar operaciones importantes |
| `EncryptableTrait` | En datos personales (nombres, doc, dirección) |
| Form Request | Para cualquier input del usuario |
| Scopes | Para filtros que se usan más de una vez |
| Policy | Para autorizar acceso a recursos por usuario |
| Repository | Para toda query a la BD |
| Event/Listener | Para efectos secundarios desacoplados |
| Observer | Para auditoría automática de modelos |
| Job | Para operaciones que toman tiempo (>1 segundo) |

---

## 📋 Archivos del proyecto más importantes

| Archivo | Propósito |
|---------|-----------|
| `routes/api.php` | Todas las rutas de la API |
| `app/Http/Controllers/Api/` | Controllers |
| `app/Models/` | Modelos Eloquent |
| `app/Traits/ApiResponse.php` | Formato de respuestas |
| `app/Traits/LogTrait.php` | Sistema de logs |
| `app/Traits/EncryptableTrait.php` | Encriptación |
| `app/Helpers/Helpers.php` | Helpers financieros |
| `database/migrations/` | Estructura de BD |
