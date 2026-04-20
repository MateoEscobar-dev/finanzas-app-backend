# 💻 Referencia Rápida — Finanzas App Backend

## 🚦 Flujo obligatorio para cualquier feature

```
FormRequest → Controller → Service → Repository → Model + Scopes
                                    ↓
                             Events → Listeners
                                    ↓
                            Observers (auditoría)
                                    ↓
                         Jobs (si hay operación pesada)
                                    ↓
                      Broadcasting (si hay tiempo real)
```

---

## 📦 Crear una feature completa — Template

### 1. Modelo con Scopes

```php
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'account_id', 'amount', 'type', 'date', 'description'];

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeCurrentMonth(Builder $query): Builder
    {
        return $query->whereMonth('date', now()->month)->whereYear('date', now()->year);
    }

    public function scopeExpenses(Builder $query): Builder
    {
        return $query->where('type', 'expense');
    }

    public function scopeIncomes(Builder $query): Builder
    {
        return $query->where('type', 'income');
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function account(): BelongsTo { return $this->belongsTo(Account::class); }
}
```

### 2. Repository Interface + Implementación

```php
// app/Repositories/Contracts/TransactionRepositoryInterface.php
interface TransactionRepositoryInterface
{
    public function getUserTransactions(int $userId, array $filters = []): Collection;
    public function create(array $data): Transaction;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}

// app/Repositories/Eloquent/EloquentTransactionRepository.php
class EloquentTransactionRepository implements TransactionRepositoryInterface
{
    public function getUserTransactions(int $userId, array $filters = []): Collection
    {
        return Transaction::byUser($userId)
            ->when($filters['from'] ?? null, fn($q, $from) => $q->where('date', '>=', $from))
            ->when($filters['to'] ?? null, fn($q, $to) => $q->where('date', '<=', $to))
            ->when($filters['type'] ?? null, fn($q, $type) => $q->ofType($type))
            ->get();
    }

    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }
}
```

### 3. Service Provider binding

```php
// app/Providers/RepositoryServiceProvider.php
$this->app->bind(TransactionRepositoryInterface::class, EloquentTransactionRepository::class);
```

### 4. Service

```php
class TransactionService
{
    public function __construct(
        private readonly TransactionRepositoryInterface $transactionRepository
    ) {}

    public function create(array $data, int $userId): Transaction
    {
        $data['user_id'] = $userId;
        $transaction = $this->transactionRepository->create($data);
        event(new ExpenseCreated($transaction));
        return $transaction;
    }
}
```

### 5. Form Request

```php
class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'amount'      => ['required', 'numeric', 'min:0.01'],
            'type'        => ['required', 'in:income,expense'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'account_id'  => ['required', 'integer', 'exists:accounts,id'],
            'date'        => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required'      => 'El monto es requerido',
            'type.in'              => 'El tipo debe ser ingreso o gasto',
            'category_id.exists'   => 'La categoría no existe',
        ];
    }
}
```

### 6. Policy

```php
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

### 7. Controller

```php
class TransactionController extends Controller
{
    use ApiResponse, LogTrait;

    public function __construct(
        private readonly TransactionService $transactionService
    ) {}

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        try {
            $transaction = $this->transactionService->create(
                $request->validated(),
                auth()->id()
            );
            $this->createLog('transactions', 'CREATE', $transaction->id);
            return $this->successResponse($transaction, 'Transacción creada', 201);
        } catch (\Throwable $th) {
            $this->createLog('transactions', 'CREATE', 0, $th);
            return $this->errorResponse('Error al crear transacción', [], 500);
        }
    }

    public function show(Transaction $transaction): JsonResponse
    {
        $this->authorize('view', $transaction);
        return $this->successResponse($transaction, 'Transacción obtenida');
    }
}
```

### 8. Observer

```php
class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        // Auditoría automática
        Log::info('Transaction created', ['id' => $transaction->id]);
    }
    public function updated(Transaction $transaction): void { ... }
    public function deleted(Transaction $transaction): void { ... }
}
// Registrar en AppServiceProvider::boot():
Transaction::observe(TransactionObserver::class);
```

---

## 🎯 Respuestas API — Cheat Sheet

```php
// 200 OK
return $this->successResponse($data, 'Mensaje');

// 201 Created
return $this->successResponse($data, 'Creado', 201);

// 202 Accepted (Job encolado)
return $this->successResponse(null, 'Procesando', 202);

// 422 Validation (automático con FormRequest)

// 403 Forbidden
return $this->errorResponse('No autorizado', [], 403);

// 404 Not Found
return $this->errorResponse('No encontrado', [], 404);

// 500 Server Error
return $this->errorResponse('Error interno', [], 500);
```

---

## 📋 Comandos Artisan más usados

```bash
php artisan make:model Transaction -mfs         # Model + Migration + Factory + Seeder
php artisan make:request StoreTransactionRequest
php artisan make:policy TransactionPolicy --model=Transaction
php artisan make:observer TransactionObserver --model=Transaction
php artisan make:event ExpenseCreated
php artisan make:listener CheckBudgetExceeded --event=ExpenseCreated
php artisan make:job GenerateFinancialReport
php artisan route:list --path=api
php artisan queue:work
php artisan reverb:start
```

---

## 🔑 Traits disponibles

| Trait | Uso | Importar |
|-------|-----|---------|
| `ApiResponse` | Respuestas JSON | `use App\Traits\ApiResponse;` |
| `LogTrait` | Logging | `use App\Traits\LogTrait;` |
| `EncryptableTrait` | Encriptar campos | `use App\Traits\EncryptableTrait;` |

---

## 🔢 Helpers globales (sin importar)

```php
transformNumber(1250000)         // → "$ 1.250.000"
cleanNumber("$ 1.250.000")       // → 1250000.0
```
