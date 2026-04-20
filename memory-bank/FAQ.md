# ❓ FAQ — Preguntas Frecuentes

## Generales

**¿Qué es esta aplicación?**  
Una API REST para una app de finanzas personales gratuita. Los usuarios registran gastos/ingresos, gestionan cuentas y presupuestos.

**¿Es gratuita?**  
Sí, la aplicación es completamente gratuita. No hay planes de pago.

**¿Qué stack usa?**  
PHP 8.3+, Laravel 13, Sanctum 4, Spatie Permission 7.3, MySQL 8+.

---

## Autenticación

**¿Cómo funciona la autenticación?**  
Laravel Sanctum con tokens Bearer. El cliente hace login, recibe un token y lo envía en el header `Authorization: Bearer {token}` en cada petición.

**¿Cuánto dura el token?**  
Por defecto no expiran. Se revocan manualmente con `POST /api/logout`.

**¿Cómo proteger una ruta nueva?**  
Agregarla dentro del grupo `Route::middleware('auth:sanctum')` en `routes/api.php`.

---

## Arquitectura y Patrones

**¿Por qué Repository Pattern y no queries directas?**  
Permite cambiar el origen de datos sin tocar los Controllers, facilita el testing con mocks, y mantiene los Controllers limpios.

**¿Cuándo uso un Service y cuándo un Repository?**  
- **Repository** → Solo acceso a BD (queries, CRUD)
- **Service** → Lógica de negocio (combina repositorios, dispara eventos, valida reglas)

**¿Puedo hacer `Transaction::where(...)` en el Controller?**  
No. Es un antipatrón. Toda query va a través de un Repository.

**¿Cuándo crear un Trait vs una clase de utilidad?**  
Trait si la lógica se mezcla en múltiples clases sin composición. Clase si tiene estado propio o necesita inyección de dependencias.

**¿Cuándo usar `event()` vs llamar directamente al listener?**  
Usa `event()` cuando el efecto secundario no está 100% acoplado a la acción. Beneficios: múltiples listeners, async, testable por separado.

---

## Modelos y Base de Datos

**¿Cómo agrego un campo encriptado a un modelo?**  
Agregar el campo al array `$encryptable` del modelo:
```php
protected $encryptable = ['numero_cuenta', 'rfc'];
```
También ejecutar la migración para añadir el campo a la tabla.

**¿Cómo funciona la encriptación?**  
Se usan funciones SQL `encrypt_data()` y `decrypt_data()` a nivel de BD. El `EncryptableTrait` las llama automáticamente al guardar/leer.

**¿Qué son los Scopes y cuándo los uso?**  
Scopes son métodos del modelo que encapsulan filtros comunes. Úsalos cuando aplicas el mismo `where()` en más de un lugar:
```php
Transaction::byUser($id)->currentMonth()->expenses()->get();
```

**¿Dónde registro un Observer?**  
En `AppServiceProvider::boot()`, NO en el constructor del modelo:
```php
Transaction::observe(TransactionObserver::class);
```

---

## Controllers y Validaciones

**¿Siempre necesito un Form Request?**  
Sí, para cualquier input del usuario. Nunca usar `$request->validate()` directamente en el Controller.

**¿Dónde van las reglas de validación personalizadas?**  
En el Form Request correspondiente, método `rules()`. Los mensajes en `messages()`.

**¿Cómo retorno una respuesta de error de validación?**  
Laravel lo hace automáticamente al usar Form Requests (retorna 422 con los errores). No necesitas manejar esto manualmente.

---

## Autorización

**¿Cómo limito que un usuario solo vea sus propias transacciones?**  
Con una Policy:
```php
// app/Policies/TransactionPolicy.php
public function view(User $user, Transaction $transaction): bool
{
    return $user->id === $transaction->user_id;
}
// En Controller:
$this->authorize('view', $transaction);
```

**¿Cuándo usar Gate vs Policy?**  
- **Policy** → Autorización sobre un modelo específico (`puede editar ESTA transacción?`)
- **Gate** → Permisos simples sin modelo (`puede acceder a reportes?`)

**¿Spatie Permission reemplaza a las Policies?**  
No. Spatie maneja roles/permisos de sistema (¿es admin?). Policies manejan ownership (¿es su recurso?). Ambos se usan juntos.

---

## Colas y Jobs

**¿Qué operaciones deben ser asíncronas (Jobs)?**  
- Generar PDF/Excel
- Enviar emails
- Importar/exportar CSVs grandes
- Recalcular estadísticas masivas
- Cualquier operación que tome más de ~1 segundo

**¿Cómo despacho un Job?**  
```php
GenerateFinancialReport::dispatch($userId, $year, $month, 'pdf');
return $this->successResponse(null, 'Procesando reporte', 202);
```

**¿Cómo iniciar el worker en desarrollo?**  
```bash
php artisan queue:work
```

---

## WebSockets

**¿Para qué se usa Reverb en esta app?**  
Para notificaciones en tiempo real: alertas de presupuesto excedido, balance actualizado, reporte listo para descargar.

**¿Necesito Reverb para el core de la app?**  
No. Es opcional. La app funciona sin WebSockets, solo sin notificaciones en tiempo real.

**¿Cómo escucho eventos en el frontend?**  
```javascript
window.Echo.private(`user.${userId}`)
    .listen('.budget.exceeded', (data) => {
        alert(`¡Presupuesto de ${data.category} excedido!`);
    });
```

---

## Reportes y Exportación

**¿Cómo funciona la generación de reportes?**  
1. Usuario pide reporte → Controller despacha Job → retorna 202
2. Job genera el archivo → broadcast evento `report.ready`
3. Frontend recibe evento → descarga el archivo

**¿Qué formatos soportará?**  
CSV (básico), Excel y PDF (a implementar).

---

## Helpers

**¿Cómo formato un número como moneda COP?**  
```php
transformNumber(1250000)  // → "$ 1.250.000"
```

**¿Cómo proceso un número con formato COP?**  
```php
cleanNumber("$ 1.250.000")  // → 1250000.0
```

**¿Dónde agrego una nueva función helper?**  
En `app/Helpers/Helpers.php`. Ya está registrado en el autoload de Composer.
