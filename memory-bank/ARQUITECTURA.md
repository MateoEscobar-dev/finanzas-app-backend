# 🏗️ Arquitectura — Finanzas App Backend

> Este archivo es un alias de [ARCHITECTURE.md](ARCHITECTURE.md).
> Toda la documentación de arquitectura está en ese archivo.

---

## Resumen ejecutivo

**Finanzas App Backend** es una API REST Laravel 13 para una app de finanzas personales gratuita.

La arquitectura sigue el patrón **Controller → Service → Repository → Model**:

```
HTTP Request
    ↓
FormRequest (validación)
    ↓
Controller (solo HTTP)
    ↓
Service (lógica de negocio)
    ↓
Repository (acceso a datos)
    ↓
Model + Scopes (dominio)
    ↓
MySQL
```

Ver documentación completa en [ARCHITECTURE.md](ARCHITECTURE.md).

## Patrones obligatorios

1. **Repository Pattern** — Toda query pasa por un Repository
2. **Service Layer** — Lógica de negocio en Services, no en Controllers
3. **Policies** — Autorización de recursos por usuario
4. **Events/Listeners** — Efectos secundarios desacoplados
5. **Observers** — Auditoría automática de modelos
6. **Queue Jobs** — Operaciones pesadas asíncronas
7. **Form Requests** — Validación fuera del Controller
8. **Scopes** — Filtros comunes en los Models
9. **Traits** — Comportamientos compartidos (ApiResponse, LogTrait, EncryptableTrait)

Ver detalles y ejemplos en [CODING-STANDARDS.md](CODING-STANDARDS.md).

## Reglas críticas

Ver [ARQUITECTURA-CRITERIOS-CRITICOS.md](ARQUITECTURA-CRITERIOS-CRITICOS.md) para las reglas que **nunca se violan**.
