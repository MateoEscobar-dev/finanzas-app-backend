# 🎯 Contexto Activo — Finanzas App Backend

> Actualizar este archivo al iniciar/terminar cada feature.  
> Última actualización: 2026-04-20

---

## 🏗️ Estado del Proyecto: Fundación

**Fase actual:** Construcción de la base del sistema (Auth, Usuarios, Menús, Permisos)

---

## ✅ Features Completadas

### Auth — Completado
- Login con Sanctum (`POST /api/login`)
- Logout (`POST /api/logout`)
- Usuario autenticado (`GET /api/me`)
- Respuestas JSON con `ApiResponse` trait

### Gestión de Usuarios — Completado
- CRUD completo (`GET|POST|PUT|DELETE /api/user`)
- Encriptación de datos sensibles (`EncryptableTrait`)
- Validaciones con Form Requests (`StoreUserRequest`, `UpdateUserRequest`)
- Activar/Desactivar usuario
- Historial de usuario
- Cambio de idioma
- Roles y permisos con Spatie Permission

### Sistema de Menús — Completado
- CRUD de menús (`/api/menu`)
- Menú jerárquico (`GET /api/menu/hierarchical`)
- Menú por sistema (`GET /api/menu/by-system/{id}`)
- Scopes: `rootMenus()`, `visible()`
- Método `toHierarchical()` en el modelo

### Roles y Permisos — Completado
- Listar roles (`GET /api/roles`)
- Ver rol específico (`GET /api/roles/{id}`)
- Listar permisos (`GET /api/permissions`)
- Spatie Permission integrado

### Sistema de Logs — Completado
- `Logs` — Registro de operaciones CRUD
- `ErrorException` — Captura de excepciones
- `LogsInformation` — Información adicional de logs
- `LogTrait` — Trait para crear logs desde cualquier clase

### Helpers Financieros — Completado
- `cleanNumber()` — Limpia formato COP → número
- `transformNumber()` — Número → formato COP con separadores

---

## 🔄 En Progreso

> *No hay features en progreso actualmente. Esperando nueva tarea.*

---

## 📋 Pendiente por Implementar

### Core de Finanzas (Alta prioridad)
- [ ] **Categorías** — CRUD de categorías de ingresos/gastos
- [ ] **Transacciones** — CRUD de gastos e ingresos
- [ ] **Cuentas** — Cuentas bancarias/efectivo del usuario
- [ ] **Balance** — Cálculo de balance por cuenta/global

### Presupuestos (Media prioridad)
- [ ] **Presupuestos** — Límites de gasto por categoría/mes
- [ ] **Alertas de presupuesto** — Notificación cuando se excede

### Reportes (Media prioridad)
- [ ] **Reporte mensual** — Resumen de gastos/ingresos por mes
- [ ] **Reporte anual** — Resumen de gastos/ingresos por año
- [ ] **Exportación** — CSV/Excel/PDF de transacciones

### Metas financieras (Baja prioridad)
- [ ] **Goals** — Metas de ahorro
- [ ] **Seguimiento** — Progreso hacia metas

### Infraestructura técnica
- [ ] Implementar `Repository Pattern` (Repositories + Interfaces)
- [ ] Implementar `Service Layer`
- [ ] Implementar `Events/Listeners` para transacciones
- [ ] Implementar `Observers` para auditoría de transacciones
- [ ] Implementar `Policies` para autorización de transacciones
- [ ] Configurar `Queue Jobs` para reportes y notificaciones
- [ ] Configurar `Broadcasting` para alertas en tiempo real

---

## 🗄️ Modelos implementados actualmente

| Modelo | Tabla | Descripción |
|--------|-------|-------------|
| `User` | `users` | Usuario con datos encriptados |
| `Menu` | `menus` | Menú jerárquico de navegación |
| `Logs` | `logs` | Registro de operaciones |
| `ErrorException` | `error_exceptions` | Captura de excepciones |
| `LogsInformation` | `logs_information` | Info adicional de logs |

---

## 🛣️ Rutas activas

```
POST   /api/login
POST   /api/logout                    [auth:sanctum]
GET    /api/me                        [auth:sanctum]

GET    /api/menu/hierarchical         [auth:sanctum]
GET    /api/menu/by-system/{id}       [auth:sanctum]
GET|POST /api/menu                    [auth:sanctum]
GET|PUT|DELETE /api/menu/{id}         [auth:sanctum]

GET    /api/roles                     [auth:sanctum]
GET    /api/roles/{id}                [auth:sanctum]
GET    /api/permissions               [auth:sanctum]

GET|POST /api/user                    [auth:sanctum]
GET|PUT|DELETE /api/user/{id}         [auth:sanctum]
POST   /api/user/{id}/activate        [auth:sanctum]
POST   /api/user/{id}/deactivate      [auth:sanctum]
GET    /api/user/{id}/history         [auth:sanctum]
POST   /api/user/{id}/language        [auth:sanctum]
```

---

## ⚙️ Decisiones técnicas tomadas

| Decisión | Razón |
|----------|-------|
| Sanctum para auth (no JWT) | Más simple para SPA/mobile, integrado en Laravel |
| Spatie Permission para roles | Estándar de la industria en Laravel |
| Encriptación a nivel de modelo | Datos personales sensibles (documento, nombre, dirección) |
| Respuestas con ApiResponse trait | Formato consistente en toda la API |
| Form Requests para validaciones | Separación de responsabilidades, controladores limpios |
