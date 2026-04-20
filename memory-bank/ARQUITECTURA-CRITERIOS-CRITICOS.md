# 🔴 ARQUITECTURA — CRITERIOS CRÍTICOS OBLIGATORIOS

> **CUMPLIMIENTO OBLIGATORIO.** Estas reglas NUNCA se violan, sin excepciones.
> Cualquier código que las infrinja debe ser rechazado y reescrito.

---

## 1. Programación Orientada a Objetos — SIEMPRE

### 1.1 Usar abstracción antes que duplicación

❌ **INCORRECTO — Código copiado**
```php
// En TransactionController
$transactions = Transaction::where('user_id', auth()->id())->get();

// En ReportController
$transactions = Transaction::where('user_id', auth()->id())->get();
```

✅ **CORRECTO — Abstracción con Repository**
```php
// app/Repositories/TransactionRepository.php
public function getUserTransactions(int $userId): Collection { ... }

// En el Controller
$transactions = $this->transactionRepository->getUserTransactions(auth()->id());
```

---

### 1.2 Usar polimorfismo antes que condicionales tipo `if/switch` por tipo

❌ **INCORRECTO — Switch por tipo**
```php
if ($type === 'income') {
    $balance += $amount;
} elseif ($type === 'expense') {
    $balance -= $amount;
}
```

✅ **CORRECTO — Polimorfismo**
```php
// Cada tipo de transacción implementa su propio cálculo
$transaction->applyToBalance($balance);
```

---

### 1.3 Usar Interfaces como contratos

Toda clase que pueda intercambiarse (repositorios, servicios) DEBE implementar una interfaz:

```php
interface TransactionRepositoryInterface
{
    public function findByUser(int $userId): Collection;
    public function create(array $data): Transaction;
    public function delete(int $id): bool;
}

class EloquentTransactionRepository implements TransactionRepositoryInterface { ... }
```

El binding debe hacerse en un Service Provider:
```php
$this->app->bind(TransactionRepositoryInterface::class, EloquentTransactionRepository::class);
```

---

## 2. Repository Pattern — OBLIGATORIO para acceso a datos

- Los **Controllers** NO acceden directamente a Eloquent (solo a través de Repositories o Services)
- Los **Repositories** son la única capa que hace queries a la BD
- Los **Services** contienen lógica de negocio y usan Repositories
- Estructura obligatoria:

```
app/
├── Repositories/
│   ├── Contracts/              ← Interfaces
│   │   └── TransactionRepositoryInterface.php
│   └── Eloquent/               ← Implementaciones
│       └── EloquentTransactionRepository.php
├── Services/
│   └── TransactionService.php  ← Lógica de negocio
└── Http/
    └── Controllers/Api/
        └── TransactionController.php  ← Solo HTTP / respuestas
```

---

## 3. Traits — Para comportamientos compartidos

Crear un trait cuando la misma lógica aparece en 2+ clases:

| Trait existente | Responsabilidad |
|----------------|----------------|
| `ApiResponse` | Formato de respuestas JSON |
| `LogTrait` | Registro de operaciones |
| `EncryptableTrait` | Encriptación de campos sensibles |

**Cuándo crear un nuevo trait:** lógica de filtrado reutilizable, cálculos financieros compartidos, formateo de datos.

---

## 4. Scopes — Para filtros en modelos Eloquent

Los filtros comunes SIEMPRE van como scopes en el modelo, NO en el Controller:

```php
// ✅ CORRECTO — En el Model
public function scopeByUser(Builder $query, int $userId): Builder
{
    return $query->where('user_id', $userId);
}

public function scopeInDateRange(Builder $query, string $from, string $to): Builder
{
    return $query->whereBetween('date', [$from, $to]);
}

public function scopeByCategory(Builder $query, int $categoryId): Builder
{
    return $query->where('category_id', $categoryId);
}

// Uso limpio en el Repository:
Transaction::byUser($userId)->inDateRange($from, $to)->byCategory($categoryId)->get();
```

---

## 5. Eventos y Listeners — Para desacoplar efectos secundarios

Cuando una acción dispara múltiples efectos → usar Events + Listeners:

```php
// Registrar un gasto dispara:
event(new ExpenseCreated($expense));

// Listeners independientes:
// → NotifyBudgetExceeded (si supera el presupuesto)
// → UpdateMonthlyBalance (recalcula balance del mes)
// → LogFinancialActivity (registra en logs)
```

**Regla:** Si un método hace más de una cosa AND esas cosas no están 100% acopladas → separar con eventos.

---

## 6. Observers — Para auditoría automática

Los modelos financieros (transacciones, presupuestos) DEBEN tener observers:

```php
class TransactionObserver
{
    public function created(Transaction $transaction): void { ... }
    public function updated(Transaction $transaction): void { ... }
    public function deleted(Transaction $transaction): void { ... }
}
```

Registrar en el Service Provider, NO en el constructor del modelo.

---

## 7. Policies — Para autorización de recursos

NUNCA usar `if ($transaction->user_id !== auth()->id())` en el Controller. Usar Policies:

```php
// app/Policies/TransactionPolicy.php
public function view(User $user, Transaction $transaction): bool
{
    return $user->id === $transaction->user_id;
}

// En el Controller:
$this->authorize('view', $transaction);
```

---

## 8. Queue Jobs — Para operaciones asíncronas

Las operaciones pesadas NUNCA bloquean la respuesta HTTP:

| Operación | Debe ser Job |
|-----------|-------------|
| Generar reportes PDF/Excel | ✅ Sí |
| Enviar emails/notificaciones | ✅ Sí |
| Importar CSV de transacciones | ✅ Sí |
| Recalcular estadísticas | ✅ Sí |
| Leer un registro por ID | ❌ No |

---

## 9. Broadcasting — Para tiempo real

Eventos en tiempo real cuando el usuario necesita ver cambios sin recargar:

- Alerta de presupuesto excedido
- Actualización de balance en vivo
- Notificación de transacción entrante

---

## 10. Streams / Lazy Collections — Para datos masivos

Al procesar o exportar grandes volúmenes de transacciones usar `LazyCollection` o `cursor()`:

```php
// ❌ INCORRECTO — Carga todo en memoria
Transaction::byUser($userId)->get()->each(fn($t) => $this->process($t));

// ✅ CORRECTO — Procesa de a uno
Transaction::byUser($userId)->cursor()->each(fn($t) => $this->process($t));
```

---

## 11. Helpers — Para funciones de utilidad global

Las funciones de formato financiero y de utilidad global van en `app/Helpers/Helpers.php` (autoload en composer.json):

```php
// Funciones disponibles globalmente:
cleanNumber($value)      // Limpia formato COP → número
transformNumber($value)  // Número → formato COP con separadores
```

---

## 12. Relaciones Polimórficas — Para entidades reutilizables

Los comentarios, archivos adjuntos, notificaciones, etiquetas → polimórficos:

```php
// Un comentario puede pertenecer a Transaction, Budget, Goal, etc.
public function commentable(): MorphTo
{
    return $this->morphTo();
}
```

---

## 13. Service Providers — Para configuración y binding

Los bindings de interfaces → implementaciones van en Service Providers, NUNCA en los controllers:

```php
// app/Providers/RepositoryServiceProvider.php
$this->app->bind(
    TransactionRepositoryInterface::class,
    EloquentTransactionRepository::class
);
```

---

## ❌ Antipatrones PROHIBIDOS

| Antipatrón | Por qué está prohibido |
|-----------|----------------------|
| Fat Controllers | Violan SRP, dificultan testeo |
| Queries en Controllers | Violan Repository Pattern |
| `if/switch` por tipo de entidad | Usar polimorfismo |
| Lógica duplicada en 2+ lugares | Usar traits o servicios |
| Operaciones pesadas en HTTP | Usar Jobs/Queue |
| `User::all()` sin filtros | Riesgo de memoria + performance |
| Datos sensibles sin encriptar | Usar `EncryptableTrait` |
| Autorización manual en Controller | Usar Policies |

---

## ✅ Criterios de Aceptación mínimos para cualquier PR/feature

- [ ] Usa Repository Pattern (no queries directas en Controllers)
- [ ] Usa Form Requests para validación (no `$request->validate()` en Controller)
- [ ] Usa Policies para autorización de recursos
- [ ] Los efectos secundarios están en Events/Listeners (no acoplados al método)
- [ ] Los modelos tienen Scopes para filtros comunes
- [ ] Las operaciones pesadas van en Jobs
- [ ] Los datos sensibles usan EncryptableTrait
- [ ] No hay lógica duplicada (usar Traits o Helpers)
- [ ] Respuestas HTTP usan el Trait `ApiResponse`
- [ ] Logs usan el Trait `LogTrait`
