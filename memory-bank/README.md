# 💰 Finanzas App — Backend API

## ¿Qué es esto?

**API REST** para una aplicación de finanzas personales **gratuita**. Permite a los usuarios gestionar sus gastos, ingresos, presupuestos, metas de ahorro y obtener reportes de su salud financiera.

---

## 🎯 Propósito de la aplicación

Ayudar a cualquier persona a:
- 📊 Registrar gastos e ingresos fácilmente
- 💳 Administrar múltiples cuentas (banco, efectivo, tarjetas)
- 🏷️ Categorizar transacciones
- 📅 Gestionar presupuestos mensuales por categoría
- 🎯 Crear y seguir metas de ahorro
- 📈 Ver reportes y estadísticas financieras
- 🔔 Recibir alertas cuando supera el presupuesto

---

## 🛠️ Stack Tecnológico

| Tecnología | Versión | Propósito |
|-----------|---------|-----------|
| PHP | ^8.3 | Lenguaje base |
| Laravel | ^13.0 | Framework |
| Laravel Sanctum | ^4.0 | Autenticación API (tokens) |
| Spatie Permission | ^7.3 | Roles y permisos |
| MySQL | 8+ | Base de datos |
| Laravel Reverb | — | WebSockets (alertas en tiempo real) |
| Laravel Queue | — | Jobs asíncronos (reportes, emails) |

---

## ✅ Implementado actualmente

- **Auth** — Login/logout/me con Sanctum
- **Usuarios** — CRUD con encriptación de datos sensibles, roles y permisos
- **Menús** — Sistema de navegación jerárquico configurable
- **Roles y Permisos** — Spatie Permission integrado
- **Logs** — Sistema de auditoría multi-tabla
- **Helpers** — Formato de moneda COP

Ver progreso completo en [progress.md](progress.md)

---

## 🗺️ Roadmap

1. **Sprint 1** — Core: Categorías, Cuentas, Transacciones, Balance
2. **Sprint 2** — Presupuestos y alertas en tiempo real
3. **Sprint 3** — Reportes y exportación (PDF/Excel/CSV)
4. **Sprint 4** — Metas de ahorro
5. **Sprint 5** — Infraestructura: Repository Pattern, Events, Observers, Policies

---

## 📁 Estructura del Proyecto

```
finanzas-app-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/    # Auth, User, Menu, Role + futuros
│   │   ├── Middleware/
│   │   └── Requests/           # Form Requests con validaciones
│   ├── Models/                 # User, Menu, Logs, ErrorException
│   ├── Traits/                 # ApiResponse, LogTrait, EncryptableTrait
│   ├── Helpers/                # Helpers.php (cleanNumber, transformNumber)
│   └── Providers/
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── api.php
└── memory-bank/                # Documentación del proyecto
```

---

## 🔗 Documentación

| Archivo | Propósito |
|---------|-----------|
| [memory-bank-instructions.md](memory-bank-instructions.md) | Cómo usar el memory bank |
| [ARCHITECTURE.md](ARCHITECTURE.md) | Arquitectura completa del sistema |
| [CODING-STANDARDS.md](CODING-STANDARDS.md) | Estándares de codificación |
| [ARQUITECTURA-CRITERIOS-CRITICOS.md](ARQUITECTURA-CRITERIOS-CRITICOS.md) | Reglas críticas obligatorias |
| [activeContext.md](activeContext.md) | Estado actual del proyecto |
| [progress.md](progress.md) | Progreso de features |
| [QUALITY-RULES.md](../QUALITY-RULES.md) | Reglas de calidad del código |

---

## 🚀 Quick Start

```bash
# Clonar e instalar
composer install
cp .env.example .env
php artisan key:generate

# Base de datos
php artisan migrate
php artisan db:seed

# Iniciar servidor
php artisan serve

# (Opcional) Worker de colas
php artisan queue:work

# (Opcional) WebSockets
php artisan reverb:start
```
