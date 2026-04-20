# 🧠 Memory Bank — Instrucciones de Uso

## ¿Qué es el Memory Bank?

El memory bank es la **memoria persistente del proyecto**. Contiene toda la información necesaria para que cualquier sesión de trabajo (Copilot, desarrollador nuevo, revisión de código) pueda entender el estado actual, las decisiones tomadas y los estándares del proyecto.

**Leer el memory bank antes de cada tarea es OBLIGATORIO.**

---

## 🗂️ Proyecto: Finanzas App — Backend

**Tipo:** API REST — Aplicación de finanzas personales **gratuita**  
**Stack:** PHP 8.3+, Laravel 13, Sanctum 4, Spatie Permission 7.3  
**Base de datos:** MySQL  
**Arquitectura:** API-first, Repository Pattern, Service Layer  
**Dominio:** Gestión de gastos, ingresos, presupuestos y reportes financieros personales

---

## 📚 Archivos del Memory Bank — Guía de lectura

### Leer SIEMPRE antes de cualquier tarea

| Archivo | Propósito | Prioridad |
|---------|-----------|-----------|
| [memory-bank-instructions.md](memory-bank-instructions.md) | Este archivo — flujo de trabajo | 🔴 Obligatorio |
| [ARQUITECTURA-CRITERIOS-CRITICOS.md](ARQUITECTURA-CRITERIOS-CRITICOS.md) | Reglas de arquitectura que NUNCA se violan | 🔴 Obligatorio |
| [activeContext.md](activeContext.md) | Estado actual, feature en desarrollo | 🔴 Obligatorio |
| [progress.md](progress.md) | Progreso de features implementadas | 🔴 Obligatorio |

### Leer según la tarea

| Archivo | Cuándo leerlo |
|---------|--------------|
| [ARCHITECTURE.md](ARCHITECTURE.md) | Al diseñar nuevas features o módulos |
| [CODING-STANDARDS.md](CODING-STANDARDS.md) | Al escribir cualquier código |
| [DOCUMENTATION.md](DOCUMENTATION.md) | Al entender el sistema completo |
| [QUICK_REFERENCE.md](QUICK_REFERENCE.md) | Referencia rápida de patrones y comandos |
| [FAQ.md](FAQ.md) | Ante dudas recurrentes |

### Referencia de features implementadas

| Archivo | Feature |
|---------|---------|
| [README_API_USUARIOS.md](README_API_USUARIOS.md) | API de Usuarios |
| [API_USUARIOS_GUIA.md](API_USUARIOS_GUIA.md) | Endpoints de Usuarios |
| [MENU_SYSTEM_DOCUMENTATION.md](MENU_SYSTEM_DOCUMENTATION.md) | Sistema de Menús |
| [MENU_QUICK_REFERENCE.md](MENU_QUICK_REFERENCE.md) | Referencia rápida de Menús |
| [QUEUE_SETUP.md](QUEUE_SETUP.md) | Configuración de Colas |
| [LARAVEL_REVERB_SETUP.md](LARAVEL_REVERB_SETUP.md) | WebSockets con Reverb |

---

## 🔄 Flujo de trabajo Kiro-Lite

```
1. PRD     → Definir qué se va a construir y por qué
2. Diseño  → Definir arquitectura, modelos, contratos de interface
3. Tareas  → Dividir en pasos implementables (actualizar activeContext.md)
4. Código  → Implementar siguiendo CODING-STANDARDS.md
5. Update  → Al terminar, actualizar activeContext.md y progress.md
```

---

## 📝 En "/update memory bank"

Cuando el usuario pide actualizar el memory bank, actualizar:

1. **[activeContext.md](activeContext.md)** — Cambiar el estado de la feature actual, features en progreso
2. **[progress.md](progress.md)** — Marcar features completadas, agregar nuevas pendientes
3. Si se creó arquitectura nueva → actualizar [ARCHITECTURE.md](ARCHITECTURE.md)
4. Si se crearon patrones nuevos → actualizar [CODING-STANDARDS.md](CODING-STANDARDS.md)

---

## ⚠️ Reglas de escritura de código

- **SIEMPRE** seguir [ARQUITECTURA-CRITERIOS-CRITICOS.md](ARQUITECTURA-CRITERIOS-CRITICOS.md)
- **SIEMPRE** seguir [CODING-STANDARDS.md](CODING-STANDARDS.md)
- **SIEMPRE** seguir [QUALITY-RULES.md](../QUALITY-RULES.md) en la raíz del proyecto
- El código debe ser **profesional, estructurado y reutilizable**
- No hacer `if` en lugar de polimorfismo, no copiar-pegar en lugar de abstraer

---

## 🏗️ Estructura de carpetas del proyecto

```
finanzas-app-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/    # Controladores de la API REST
│   │   ├── Middleware/         # Middlewares
│   │   └── Requests/           # Form Requests (validaciones)
│   ├── Models/                 # Eloquent Models
│   ├── Traits/                 # Traits reutilizables
│   ├── Helpers/                # Helpers globales
│   ├── Providers/              # Service Providers
│   ├── Repositories/           # Repository Pattern (a implementar)
│   ├── Services/               # Service Layer (a implementar)
│   ├── Events/                 # Eventos Laravel (a implementar)
│   ├── Listeners/              # Listeners de eventos (a implementar)
│   ├── Jobs/                   # Queue Jobs (a implementar)
│   ├── Observers/              # Eloquent Observers (a implementar)
│   └── Policies/               # Authorization Policies (a implementar)
├── database/
│   ├── migrations/             # Migraciones de BD
│   ├── factories/              # Factories para tests
│   └── seeders/                # Seeders de datos
├── routes/
│   └── api.php                 # Rutas de la API
├── tests/
│   ├── Feature/                # Tests de integración
│   └── Unit/                   # Tests unitarios
└── memory-bank/                # Este directorio
```
