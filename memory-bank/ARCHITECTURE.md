# 🏗️ Arquitectura — Finanzas App Backend

## Visión General

```
┌────────────────────────────────────────────────────────┐
│               Cliente (Frontend / Mobile)               │
└────────────────────┬───────────────────────────────────┘
                     │ HTTP REST API
                     ▼
┌────────────────────────────────────────────────────────┐
│              Laravel 13 — API REST                      │
│                                                         │
│  Routes → Middleware → FormRequest → Controller         │
│               │                                         │
│          Service Layer                                  │
│               │                                         │
│       Repository Layer                                  │
│               │                                         │
│        Eloquent Models                                  │
└────────────────────┬───────────────────────────────────┘
                     │
                     ▼
┌────────────────────────────────────────────────────────┐
│                   MySQL 8+                              │
└────────────────────────────────────────────────────────┘
                     │
              WebSocket (Reverb)
                     │
             ┌───────────────┐
             │ Eventos en    │
             │ tiempo real   │
             └───────────────┘
```

---

## Capas de la arquitectura

### 1. HTTP Layer (Controllers + FormRequests)

**Responsabilidad:** Recibir la petición HTTP, validar entrada, delegar y retornar respuesta.

```
app/Http/
├── Controllers/Api/
│   ├── Auth/AuthController.php     ← Login, logout, me
│   ├── UserController.php          ← CRUD Usuarios
│   ├── MenuController.php          ← CRUD Menús
│   └── RoleController.php          ← Roles y permisos
├── Middleware/
└── Requests/
    ├── StoreUserRequest.php
    └── UpdateUserRequest.php
```

**Regla:** Los Controllers NO tienen lógica de negocio, NO tienen queries a BD.

---

### 2. Service Layer (a implementar)

**Responsabilidad:** Lógica de negocio, coordinación entre repositorios, dispatch de eventos.

```
app/Services/
├── Contracts/
│   ├── TransactionServiceInterface.php
│   └── FinancialReportServiceInterface.php
├── TransactionService.php
├── BudgetService.php
└── FinancialReportService.php
```

---

### 3. Repository Layer (a implementar)

**Responsabilidad:** Toda la interacción con la base de datos (queries Eloquent).

```
app/Repositories/
├── Contracts/
│   ├── TransactionRepositoryInterface.php
│   ├── BudgetRepositoryInterface.php
│   └── CategoryRepositoryInterface.php
├── Eloquent/
│   ├── EloquentTransactionRepository.php
│   ├── EloquentBudgetRepository.php
│   └── EloquentCategoryRepository.php
└── BaseRepository.php
```

---

### 4. Domain Layer (Models + Scopes + Observers)

**Responsabilidad:** Representar el dominio financiero, reglas de negocio de datos.

```
app/Models/
├── User.php                ← Con EncryptableTrait
├── Menu.php                ← Con scopes rootMenus(), visible()
├── Logs.php                ← Auditoría
├── ErrorException.php      ← Excepciones
├── LogsInformation.php     ← Metadata de logs
│
│   (A implementar):
├── Transaction.php         ← Con scopes byUser, currentMonth, expenses, incomes
├── Category.php
├── Account.php
├── Budget.php
└── Goal.php
```

---

### 5. Eventos, Listeners y Observers

```
app/
├── Events/
│   ├── ExpenseCreated.php
│   ├── IncomeReceived.php
│   ├── BudgetExceeded.php           ← ShouldBroadcast
│   └── GoalAchieved.php
├── Listeners/
│   ├── CheckBudgetExceeded.php      ← ShouldQueue
│   ├── UpdateMonthlyBalance.php
│   └── SendAlertNotification.php
└── Observers/
    ├── TransactionObserver.php
    └── BudgetObserver.php
```

---

### 6. Queue Jobs

```
app/Jobs/
├── GenerateFinancialReport.php      ← PDF/Excel async
├── ExportTransactionsCsv.php
├── ImportTransactionsCsv.php
└── SendBudgetAlertEmail.php
```

---

### 7. Policies (Autorización)

```
app/Policies/
├── TransactionPolicy.php            ← Solo el dueño puede ver/editar/borrar
├── BudgetPolicy.php
├── AccountPolicy.php
└── GoalPolicy.php
```

---

## Flujo de una petición típica

```
1. POST /api/transactions
          │
2. auth:sanctum middleware (verifica token Sanctum)
          │
3. StoreTransactionRequest (valida datos de entrada)
          │
4. TransactionController::store()
          │
5. TransactionService::create($data, $userId)
          │
6. TransactionPolicy::create() ← Verificar autorización
          │
7. EloquentTransactionRepository::create($data)
          │
8. TransactionObserver::created() ← Auditoría automática
          │
9. event(new ExpenseCreated($transaction))
          │        │
         10a.     10b.
   CheckBudget  UpdateBalance
   (ShouldQueue) (ShouldQueue)
          │
11. return $this->successResponse($transaction, 'Creado', 201)
```

---

## Autenticación

**Mecanismo:** Laravel Sanctum (tokens de API)

```
POST /api/login → { token: "1|abc..." }

Headers: Authorization: Bearer 1|abc...
```

- Tokens revocados al hacer logout
- Todas las rutas privadas protegidas con `auth:sanctum`
- Usuario disponible via `auth()->user()`

---

## Estructura de respuestas API

Siempre usar `ApiResponse` trait:

```json
{
    "status": "Success",
    "message": "Transacción creada",
    "data": { ... },
    "pagination": {
        "total": 150,
        "per_page": 10,
        "current_page": 1
    },
    "errors": null,
    "code": 201
}
```

---

## Base de datos — Modelos y relaciones futuras

```
users
  └─ has many transactions
  └─ has many accounts
  └─ has many budgets
  └─ has many goals
  └─ has many categories (custom)

transactions
  └─ belongs to user
  └─ belongs to category
  └─ belongs to account
  └─ morphMany comments      (polimórfico)
  └─ morphMany attachments   (polimórfico)
  └─ morphToMany tags        (polimórfico)

budgets
  └─ belongs to user
  └─ belongs to category
  └─ has many budget_entries

accounts
  └─ belongs to user
  └─ has many transactions

categories
  └─ belongs to user (o global si es default)
  └─ has many transactions
  └─ has many budgets

goals
  └─ belongs to user
  └─ has many goal_contributions
```

---

## Broadcasting — WebSockets con Laravel Reverb

Canal privado por usuario: `private-user.{userId}`

| Evento | Canal | Cuándo |
|--------|-------|--------|
| `budget.exceeded` | `private-user.{id}` | Presupuesto superado |
| `balance.updated` | `private-user.{id}` | Balance cambia |
| `report.ready` | `private-user.{id}` | Reporte listo para descargar |
| `goal.achieved` | `private-user.{id}` | Meta alcanzada |

---

## Seguridad

| Aspecto | Implementación |
|---------|---------------|
| Autenticación | Sanctum Bearer Token |
| Autorización | Spatie Roles + Laravel Policies |
| Datos sensibles | EncryptableTrait (AES-256) |
| Validación entrada | Form Requests |
| CORS | Laravel config |
| Rate limiting | Laravel throttle middleware |
