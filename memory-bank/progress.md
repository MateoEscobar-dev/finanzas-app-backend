# 📊 Progreso del Proyecto — Finanzas App Backend

> Historial de features completadas y roadmap de implementación.  
> Actualizar al completar o iniciar cualquier feature.

---

## 🏁 Features Completadas

### v0.1 — Fundación del Sistema (Completado: 2025-11 / 2026-04)

#### ✅ Autenticación
- [x] Login con email/password → token Sanctum
- [x] Logout con revocación de token
- [x] Endpoint `/me` — datos del usuario autenticado
- [x] Middleware `auth:sanctum` protegiendo todas las rutas privadas

#### ✅ Gestión de Usuarios
- [x] Listar usuarios con paginación y búsqueda (`GET /api/user`)
- [x] Crear usuario con roles (`POST /api/user`)
- [x] Ver usuario específico (`GET /api/user/{id}`)
- [x] Actualizar usuario (`PUT /api/user/{id}`)
- [x] Eliminar usuario (`DELETE /api/user/{id}`)
- [x] Activar/Desactivar usuario
- [x] Cambiar idioma del usuario
- [x] Ver historial de actividad
- [x] Encriptación de: documento, nombres, apellidos, dirección
- [x] Form Requests con validaciones y mensajes en español

#### ✅ Roles y Permisos
- [x] Spatie Laravel Permission integrado
- [x] Listar roles disponibles
- [x] Ver detalles de un rol
- [x] Listar permisos del sistema
- [x] Asignar roles al crear/actualizar usuarios
- [x] Tabla de permisos base en `config/permission_list.php`

#### ✅ Sistema de Menús
- [x] CRUD completo de menús
- [x] Estructura jerárquica (padre → hijos)
- [x] Menú por sistema (`id_sistema`)
- [x] Scopes: `rootMenus()`, `visible()`
- [x] Método `toHierarchical()` en el modelo
- [x] Ordenamiento por `order`

#### ✅ Sistema de Logs
- [x] Modelo `Logs` — operaciones CRUD sobre tablas
- [x] Modelo `ErrorException` — excepciones con stack trace
- [x] Modelo `LogsInformation` — metadata adicional de logs
- [x] Trait `LogTrait` — disponible en cualquier Controller
- [x] Registro automático de usuario autenticado en cada log

#### ✅ Helpers Financieros
- [x] `cleanNumber()` — elimina formato COP y convierte a float
- [x] `transformNumber()` — formatea número como "$ 1.250.000"
- [x] Autoload registrado en `composer.json`

#### ✅ Traits Globales
- [x] `ApiResponse` — respuestas JSON consistentes (success/error/info)
- [x] `LogTrait` — logging de operaciones
- [x] `EncryptableTrait` — encriptación transparente de campos

#### ✅ Infraestructura base
- [x] PHP 8.3+ con named arguments y readonly properties
- [x] Laravel 13, Sanctum 4, Spatie Permission 7.3
- [x] Migraciones base: users, logs, menus, permissions, jobs, cache
- [x] Funciones SQL: `encrypt_data`, `decrypt_data` en BD
- [x] Configuración de colas (jobs table)

---

## 🔜 Roadmap — Próximas Features

### Sprint 1 — Core Financiero (Alta prioridad)

| Feature | Descripción | Estado |
|---------|-------------|--------|
| Categorías | CRUD de categorías de ingresos/gastos personalizables | ⬜ Pendiente |
| Cuentas | Cuentas bancarias, efectivo, tarjetas del usuario | ⬜ Pendiente |
| Transacciones | Registro de gastos e ingresos | ⬜ Pendiente |
| Balance | Cálculo de balance por cuenta y global | ⬜ Pendiente |

### Sprint 2 — Presupuestos y Alertas

| Feature | Descripción | Estado |
|---------|-------------|--------|
| Presupuestos | Límites de gasto por categoría/mes | ⬜ Pendiente |
| Alertas | Notificación al exceder presupuesto | ⬜ Pendiente |
| Broadcasting | Alertas en tiempo real (Reverb) | ⬜ Pendiente |

### Sprint 3 — Reportes y Exportación

| Feature | Descripción | Estado |
|---------|-------------|--------|
| Reporte mensual | Resumen detallado de mes | ⬜ Pendiente |
| Reporte anual | Estadísticas anuales | ⬜ Pendiente |
| Exportación CSV | Export de transacciones | ⬜ Pendiente |
| Exportación PDF | Reporte en PDF | ⬜ Pendiente |
| Queue Jobs | Generación asíncrona de reportes | ⬜ Pendiente |

### Sprint 4 — Metas y Ahorro

| Feature | Descripción | Estado |
|---------|-------------|--------|
| Goals | Metas de ahorro con montos y fechas | ⬜ Pendiente |
| Seguimiento de metas | Progreso hacia cada meta | ⬜ Pendiente |
| Notificaciones de hitos | Alertas al alcanzar porcentajes | ⬜ Pendiente |

### Sprint 5 — Infraestructura Técnica Avanzada

| Feature | Descripción | Estado |
|---------|-------------|--------|
| Repository Pattern | Repositories + Interfaces + Service Providers | ⬜ Pendiente |
| Service Layer | Services con lógica de negocio | ⬜ Pendiente |
| Events/Listeners | Eventos para transacciones y presupuestos | ⬜ Pendiente |
| Observers | Auditoría automática de transacciones | ⬜ Pendiente |
| Policies | Autorización por usuario para recursos | ⬜ Pendiente |
| Lazy Collections | Para reportes de grandes volúmenes | ⬜ Pendiente |
| Tests | Feature tests para todos los endpoints | ⬜ Pendiente |

---

## 📈 Métricas del proyecto

| Métrica | Valor |
|---------|-------|
| Migraciones | 11 |
| Modelos | 5 |
| Controllers | 4 (Auth, User, Menu, Role) |
| Traits | 3 (ApiResponse, LogTrait, EncryptableTrait) |
| Helpers | 2 funciones globales |
| Form Requests | 4 (StoreUser, UpdateUser, StoreMenu, UpdateMenu) |
| Rutas | ~15 endpoints |
| Features completadas | 7 (Auth, Usuarios, Roles, Menús, Logs, Helpers, Traits) |
| Features pendientes | ~15 |

---

## 📝 Registro de cambios notables

| Fecha | Cambio |
|-------|--------|
| 2025-11 | Inicialización del proyecto Laravel 13 |
| 2025-11 | Integración de Spatie Permission |
| 2025-11 | Sistema de Menús jerárquico |
| 2025-11 | Sistema de Logs multi-tabla |
| 2025-11 | CRUD de Usuarios con encriptación |
| 2026-04 | Memory Bank renovado y alineado con el proyecto de finanzas |
| 2026-04 | Criterios de programación profesional documentados |
