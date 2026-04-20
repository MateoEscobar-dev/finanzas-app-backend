# 📐 Estándares de Codificación — Finanzas App Backend

> Estos estándares son **criterios de aceptación obligatorios**.  
> Todo el código del proyecto debe cumplirlos. No son sugerencias.

---

## Stack y versiones

| Tecnología | Versión | Uso |
|-----------|---------|-----|
| PHP | ^8.3 | Lenguaje base |
| Laravel | ^13.0 | Framework |
| Laravel Sanctum | ^4.0 | Autenticación API |
| Spatie Permission | ^7.3 | Roles y permisos |
| MySQL | 8+ | Base de datos |

---

## 1. Abstracción

### Clases base abstractas para comportamiento común

```php
// app/Repositories/BaseRepository.php
abstract class BaseRepository
{
    abstract protected function model(): string;

    public function find(int $id): ?Model
    {
        return $this->model()::find($id);
    }

    public function findOrFail(int $id): Model
    {
        return $this->model()::findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model()::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model()::whereKey($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model()::destroy($id);
    }
}
```

```php
// Uso en implementación concreta
class TransactionRepository extends BaseRepository
{
    protected function model(): string
    {
        return Transaction::class;
    }

    // Métodos específicos del contexto financiero
    public function getUserTransactions(int $userId, array $filters = []): Collection { ... }
    public function getSumByCategory(int $userId, int $categoryId): float { ... }
}
```

---

## 2. Polimorfismo

### Interfaces como contratos — OBLIGATORIO para todos los Repositories y Services

```php
// app/Repositories/Contracts/TransactionRepositoryInterface.php
interface TransactionRepositoryInterface
{
    public function getUserTransactions(int $userId, array $filters): Collection;
    public function getMonthlyBalance(int $userId, int $year, int $month): array;
    public function create(array $data): Transaction;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
```

```php
// app/Services/Contracts/FinancialReportServiceInterface.php
interface FinancialReportServiceInterface
{
    public function getMonthlyReport(int $userId, int $year, int $month): array;
    public function getAnnualSummary(int $userId, int $year): array;
    public function exportToPdf(int $userId, array $filters): string;
}
```

### Tipos polimórficos de transacción

```php
// Cada tipo implementa su comportamiento específico
interface AppliesBalance
{
    public function applyToBalance(float $current): float;
    public function getSign(): string;
}

class IncomeTransaction implements AppliesBalance
{
    public function applyToBalance(float $current): float { return $current + $this->amount; }
    public function getSign(): string { return '+'; }
}

class ExpenseTransaction implements AppliesBalance
{
    public function applyToBalance(float $current): float { return $current - $this->amount; }
    public function getSign(): string { return '-'; }
}
```

---

## 3. Traits

### Traits existentes en el proyecto

| Trait | Archivo | Uso |
|-------|---------|-----|
| `ApiResponse` | `app/Traits/ApiResponse.php` | Formato de respuestas JSON |
| `LogTrait` | `app/Traits/LogTrait.php` | Logging de operaciones |
| `EncryptableTrait` | `app/Traits/EncryptableTrait.php` | Encriptación de campos sensibles |

### Cuándo crear un nuevo Trait

- La misma lógica aparece en **2 o más clases**
- No depende de una clase específica (estado genérico)
- Ejemplos para finanzas: `HasCurrencyFormatting`, `HasDateFiltering`, `HasPagination`

### Plantilla de Trait

```php
namespace App\Traits;

trait HasCurrencyFormatting
{
    public function formatCOP(float $amount): string
    {
        return '$ ' . number_format($amount, 0, ',', '.');
    }

    public function parseCOP(string $formatted): float
    {
        return (float) str_replace(['$', '.', ',', ' '], ['', '', '.', ''], $formatted);
    }
}
```

---

## 4. Helpers

### Helpers globales — `app/Helpers/Helpers.php`

Registrado en `composer.json` bajo `autoload.files`. Disponible globalmente sin importar.

```php
// Funciones financieras globales existentes:
cleanNumber($value)      // "$ 1.250.000" → 1250000.0
transformNumber($value)  // 1250000 → "$ 1.250.000"
```

### Cuándo agregar a Helpers vs crear una clase

| Criterio | Helpers.php | Clase/Trait |
|----------|-----------|------------|
| Función utilitaria pura | ✅ | |
| Sin dependencias de clase | ✅ | |
| Necesita DI o estado | | ✅ |
| Lógica de negocio compleja | | ✅ |

---

## 5. Query Scopes

### Los filtros comunes van como Scopes en el Model

```php
// app/Models/Transaction.php
class Transaction extends Model
{
    // Scope por usuario (SIEMPRE presente en modelos de usuario)
    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    // Scope por rango de fechas
    public function scopeInDateRange(Builder $query, string $from, string $to): Builder
    {
        return $query->whereBetween('date', [$from, $to]);
    }

    // Scope por tipo (ingreso/gasto)
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    // Scope por categoría
    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    // Scope solo gastos
    public function scopeExpenses(Builder $query): Builder
    {
        return $query->where('type', 'expense');
    }

    // Scope solo ingresos
    public function scopeIncomes(Builder $query): Builder
    {
        return $query->where('type', 'income');
    }

    // Scope mes actual
    public function scopeCurrentMonth(Builder $query): Builder
    {
        return $query->whereMonth('date', now()->month)
                     ->whereYear('date', now()->year);
    }
}
```

**Uso en Repository:**
```php
Transaction::byUser($userId)
    ->inDateRange($from, $to)
    ->ofType('expense')
    ->byCategory($categoryId)
    ->get();
```

---

## 6. Eventos y Listeners

### Cuándo usar Events

Cuando una acción de dominio dispara efectos secundarios desacoplados:

| Evento | Listeners sugeridos |
|--------|-------------------|
| `ExpenseCreated` | `CheckBudgetExceeded`, `UpdateMonthlyBalance`, `LogActivity` |
| `IncomeReceived` | `UpdateMonthlyBalance`, `SendIncomeNotification` |
| `BudgetExceeded` | `SendAlertNotification`, `BroadcastAlert` |
| `GoalAchieved` | `SendCongratulationsNotification`, `LogMilestone` |

### Plantilla de Event

```php
// app/Events/ExpenseCreated.php
class ExpenseCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly Transaction $transaction,
        public readonly User $user
    ) {}
}
```

### Plantilla de Listener

```php
// app/Listeners/CheckBudgetExceeded.php
class CheckBudgetExceeded implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ExpenseCreated $event): void
    {
        $budget = Budget::byUser($event->user->id)
            ->byCategory($event->transaction->category_id)
            ->currentMonth()
            ->first();

        if ($budget && $budget->isExceeded()) {
            event(new BudgetExceeded($budget, $event->user));
        }
    }
}
```

---

## 7. Service Providers

### Registrar bindings de interfaces → implementaciones

```php
// app/Providers/RepositoryServiceProvider.php
class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            TransactionRepositoryInterface::class,
            EloquentTransactionRepository::class
        );

        $this->app->bind(
            BudgetRepositoryInterface::class,
            EloquentBudgetRepository::class
        );

        $this->app->bind(
            FinancialReportServiceInterface::class,
            FinancialReportService::class
        );
    }
}
```

Registrar en `bootstrap/providers.php`:
```php
App\Providers\RepositoryServiceProvider::class,
```

---

## 8. Streams y Lazy Collections

### Para procesar grandes volúmenes de transacciones

```php
// ❌ INCORRECTO — Carga todo en RAM
$transactions = Transaction::byUser($userId)->get();

// ✅ CORRECTO — Procesa de a uno con cursor
Transaction::byUser($userId)->cursor()->each(function (Transaction $t) {
    // Procesar sin cargar todo en memoria
});

// ✅ Para exportaciones grandes
Transaction::byUser($userId)
    ->chunkById(500, function (Collection $chunk) use ($file) {
        foreach ($chunk as $transaction) {
            fputcsv($file, $transaction->toArray());
        }
    });

// ✅ LazyCollection para transformaciones encadenadas
$report = LazyCollection::make(function () use ($userId) {
    yield from Transaction::byUser($userId)->cursor();
})->filter(fn($t) => $t->type === 'expense')
  ->groupBy('category_id')
  ->map(fn($group) => $group->sum('amount'));
```

---

## 9. Broadcasting

### Para notificaciones en tiempo real

```php
// app/Events/BudgetExceeded.php
class BudgetExceeded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function broadcastOn(): array
    {
        return [new PrivateChannel('user.' . $this->user->id)];
    }

    public function broadcastAs(): string
    {
        return 'budget.exceeded';
    }

    public function broadcastWith(): array
    {
        return [
            'budget_id'   => $this->budget->id,
            'category'    => $this->budget->category->name,
            'limit'       => $this->budget->limit,
            'spent'       => $this->budget->spent,
            'exceeded_by' => $this->budget->spent - $this->budget->limit,
        ];
    }
}
```

---

## 10. Colas de Trabajo (Jobs)

### Para operaciones pesadas asíncronas

```php
// app/Jobs/GenerateFinancialReport.php
class GenerateFinancialReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 300; // 5 minutos máximo

    public function __construct(
        private readonly int $userId,
        private readonly int $year,
        private readonly int $month,
        private readonly string $format // 'pdf' | 'excel'
    ) {}

    public function handle(FinancialReportServiceInterface $reportService): void
    {
        $path = $reportService->generateAndStore($this->userId, $this->year, $this->month, $this->format);

        broadcast(new ReportReady($this->userId, $path));
    }
}
```

**Dispatch desde Controller:**
```php
GenerateFinancialReport::dispatch(auth()->id(), $year, $month, $format);
return $this->successResponse(null, 'Reporte en procesamiento', 202);
```

---

## 11. Observadores (Observers)

### Para auditoría automática de transacciones

```php
// app/Observers/TransactionObserver.php
class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        event(new ExpenseCreated($transaction, $transaction->user));
        Log::info('Transaction created', ['id' => $transaction->id, 'user' => $transaction->user_id]);
    }

    public function updated(Transaction $transaction): void
    {
        if ($transaction->wasChanged('amount')) {
            // Recalcular balance si cambió el monto
            event(new TransactionAmountChanged($transaction));
        }
    }

    public function deleted(Transaction $transaction): void
    {
        event(new TransactionDeleted($transaction));
    }
}
```

**Registrar en el Provider (NO en el modelo):**
```php
// app/Providers/AppServiceProvider.php
Transaction::observe(TransactionObserver::class);
```

---

## 12. Policies

### Para autorización de recursos por usuario

```php
// app/Policies/TransactionPolicy.php
class TransactionPolicy
{
    public function view(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }

    public function update(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }
}
```

**Uso en Controller:**
```php
public function show(Transaction $transaction): JsonResponse
{
    $this->authorize('view', $transaction);
    // ...
}
```

---

## 13. Gates

### Para permisos simples de funcionalidades

```php
// app/Providers/AppServiceProvider.php
Gate::define('access-reports', fn(User $user) => $user->hasPermissionTo('view-reports'));
Gate::define('export-data', fn(User $user) => $user->hasPermissionTo('export-data'));

// Uso:
Gate::authorize('access-reports');
```

---

## 14. Repository Pattern — Estructura completa

```
app/
├── Repositories/
│   ├── Contracts/
│   │   ├── TransactionRepositoryInterface.php
│   │   ├── BudgetRepositoryInterface.php
│   │   ├── CategoryRepositoryInterface.php
│   │   └── GoalRepositoryInterface.php
│   ├── Eloquent/
│   │   ├── EloquentTransactionRepository.php
│   │   ├── EloquentBudgetRepository.php
│   │   ├── EloquentCategoryRepository.php
│   │   └── EloquentGoalRepository.php
│   └── BaseRepository.php
└── Services/
    ├── Contracts/
    │   └── FinancialReportServiceInterface.php
    ├── TransactionService.php
    ├── BudgetService.php
    └── FinancialReportService.php
```

---

## 15. Relaciones Polimórficas

### Para entidades reutilizables (comentarios, archivos, etiquetas)

```php
// Un Comment puede pertenecer a Transaction, Budget, Goal, etc.
// app/Models/Comment.php
class Comment extends Model
{
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}

// En Transaction, Budget, Goal:
public function comments(): MorphMany
{
    return $this->morphMany(Comment::class, 'commentable');
}

// Un Attachment puede pertenecer a Transaction, Invoice, etc.
class Attachment extends Model
{
    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }
}

// Una Tag puede aplicar a Transaction, Budget, Goal, etc.
class Tag extends Model
{
    public function taggables(): MorphToMany
    {
        return $this->morphedByMany(Transaction::class, 'taggable');
    }
}
```

---

## Convenciones de nombrado

| Elemento | Convención | Ejemplo |
|----------|-----------|---------|
| Controllers | PascalCase + Controller | `TransactionController` |
| Models | PascalCase | `Transaction` |
| Repositories | Eloquent + PascalCase + Repository | `EloquentTransactionRepository` |
| Interfaces | PascalCase + Interface | `TransactionRepositoryInterface` |
| Services | PascalCase + Service | `TransactionService` |
| Events | Acción pasada en PascalCase | `ExpenseCreated`, `BudgetExceeded` |
| Listeners | Verbo presente en PascalCase | `CheckBudgetExceeded`, `SendAlert` |
| Jobs | Verbo infinitivo en PascalCase | `GenerateFinancialReport` |
| Observers | Model + Observer | `TransactionObserver` |
| Policies | Model + Policy | `TransactionPolicy` |
| Traits | Has/Is + Comportamiento | `HasCurrencyFormatting` |
| Scopes | scope + NombreCamelCase | `scopeByUser`, `scopeCurrentMonth` |

---

## Convenciones de respuestas API

Usar siempre el trait `ApiResponse`:

```php
// Éxito
return $this->successResponse($data, 'Transacción creada', 201);

// Error de cliente
return $this->errorResponse('No autorizado', [], 403);

// Error de servidor
return $this->errorResponse('Error interno', [], 500);
```

**Estructura de respuesta:**
```json
{
    "status": "Success",
    "message": "Transacción creada",
    "data": { ... },
    "pagination": false,
    "errors": null,
    "code": 201
}
```
