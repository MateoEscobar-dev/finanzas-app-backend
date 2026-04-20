# ✅ QUALITY-RULES — Reglas de Calidad del Código

> **Finanzas App Backend** — Aplicación de finanzas personales gratuita  
> Estas reglas aplican a **todo el código** del proyecto sin excepciones.

---

## 🔴 Reglas CRÍTICAS — Cualquier violación bloquea el merge

### QR-01: Sin lógica en Controllers

Los Controllers solo hacen:
1. Recibir la petición HTTP
2. Delegar a Service/Repository
3. Retornar respuesta JSON con `ApiResponse`

```php
// ✅ CORRECTO
public function store(StoreTransactionRequest $request): JsonResponse
{
    $transaction = $this->transactionService->create($request->validated(), auth()->id());
    return $this->successResponse($transaction, 'Transacción creada', 201);
}

// ❌ INCORRECTO — Lógica de negocio en Controller
public function store(Request $request): JsonResponse
{
    $budget = Budget::where('user_id', auth()->id())->where('category_id', $request->category_id)->first();
    if ($budget && $budget->spent + $request->amount > $budget->limit) {
        // ... lógica de presupuesto
    }
    $transaction = Transaction::create([...]);
    // ... más lógica
}
```

---

### QR-02: Validaciones con Form Requests — SIEMPRE

```php
// ✅ CORRECTO — Form Request dedicado
public function store(StoreTransactionRequest $request): JsonResponse { ... }

// ❌ INCORRECTO — Validación inline
public function store(Request $request): JsonResponse
{
    $validated = $request->validate(['amount' => 'required|numeric']);
}
```

---

### QR-03: Autorización con Policies — SIEMPRE para recursos de usuario

```php
// ✅ CORRECTO
$this->authorize('update', $transaction);

// ❌ INCORRECTO — Verificación manual
if ($transaction->user_id !== auth()->id()) {
    return $this->errorResponse('No autorizado', [], 403);
}
```

---

### QR-04: Datos sensibles encriptados con EncryptableTrait

Los siguientes tipos de datos SIEMPRE deben estar en `$encryptable` del modelo:
- Números de documento/identificación
- Nombres y apellidos
- Direcciones
- Números de cuenta bancaria
- Cualquier dato personal identificable (PII)

---

### QR-05: Respuestas API con ApiResponse trait

```php
// ✅ CORRECTO
return $this->successResponse($data, 'Operación exitosa', 200);
return $this->errorResponse('Error encontrado', $errors, 422);

// ❌ INCORRECTO — Respuesta directa
return response()->json(['data' => $data]);
return response(['error' => 'mensaje'], 400);
```

---

### QR-06: Queries directas en Controllers — PROHIBIDO

```php
// ❌ PROHIBIDO en Controllers
Transaction::where('user_id', auth()->id())->get();
User::find($id);
DB::table('transactions')->insert([...]);

// ✅ CORRECTO — Via Repository
$this->transactionRepository->getUserTransactions(auth()->id());
```

---

## 🟡 Reglas IMPORTANTES — Deben cumplirse en features nuevas

### QR-07: Scopes para filtros comunes en Modelos

Cualquier filtro que se use más de una vez → `scope` en el modelo.

```php
// ✅ CORRECTO
public function scopeByUser(Builder $query, int $userId): Builder { ... }
public function scopeCurrentMonth(Builder $query): Builder { ... }
```

---

### QR-08: Efectos secundarios con Events/Listeners

Si una acción dispara múltiples efectos → Event + Listeners desacoplados.

No mezclar efectos en el mismo método donde ocurrió la acción principal.

---

### QR-09: Operaciones pesadas en Queue Jobs

| Operación | ¿Job? |
|-----------|-------|
| Generar PDF/Excel | ✅ Sí |
| Enviar emails | ✅ Sí |
| Importar CSV | ✅ Sí |
| Recalcular estadísticas masivas | ✅ Sí |
| Obtener un registro por ID | ❌ No |

---

### QR-10: Grandes volúmenes con cursor() o chunk()

```php
// ❌ INCORRECTO para > 1000 registros
Transaction::byUser($userId)->get()->each(fn($t) => ...);

// ✅ CORRECTO
Transaction::byUser($userId)->cursor()->each(fn($t) => ...);
Transaction::byUser($userId)->chunkById(500, fn($chunk) => ...);
```

---

### QR-11: Observers para auditoría automática de modelos críticos

Los modelos financieros (Transaction, Budget, Goal) DEBEN tener Observers
para registrar creates, updates y deletes automáticamente.

---

### QR-12: Sin strings mágicos — usar constantes o enums

```php
// ❌ INCORRECTO
if ($transaction->type === 'expense') { ... }
if ($user->status === 'active') { ... }

// ✅ CORRECTO
if ($transaction->type === TransactionType::EXPENSE) { ... }
if ($user->isActive()) { ... }
```

---

## 🟢 Buenas prácticas — Seguir siempre que sea posible

### QR-13: Type hints en todos los parámetros y retornos

```php
// ✅ CORRECTO
public function getUserTransactions(int $userId, array $filters = []): Collection { ... }
public function calculateBalance(int $userId): float { ... }
```

---

### QR-14: Named arguments para mayor claridad

```php
// ✅ CORRECTO
Transaction::create(
    user_id: auth()->id(),
    amount: $request->amount,
    type: TransactionType::EXPENSE,
    date: now(),
);
```

---

### QR-15: Logs con LogTrait para operaciones importantes

Cualquier operación de creación, modificación o eliminación de datos financieros
debe ser registrada usando `LogTrait::createLog()`.

---

## 📋 Checklist de revisión de código

Antes de hacer commit verificar:

- [ ] Controller no tiene queries directas a Eloquent
- [ ] Controller no tiene lógica de negocio
- [ ] Hay Form Request para las validaciones
- [ ] Hay Policy para autorización (si aplica)
- [ ] Respuestas usan ApiResponse trait
- [ ] Datos sensibles usan EncryptableTrait
- [ ] No hay código duplicado (extraer a trait/helper/service)
- [ ] Filtros comunes están como Scopes en el modelo
- [ ] Operaciones pesadas están en Jobs
- [ ] Efectos secundarios están en Listeners (no acoplados)
- [ ] Nombres de clases siguen las convenciones del CODING-STANDARDS.md
