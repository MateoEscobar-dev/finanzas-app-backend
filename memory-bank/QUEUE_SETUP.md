# Configuración de Colas (Queues) — Finanzas App

> Las colas permiten ejecutar tareas pesadas en segundo plano sin bloquear las peticiones HTTP.
> En la app de finanzas se usan para: generación de reportes, envío de emails, importación masiva de transacciones, notificaciones de alertas de presupuesto.

## Estado

El driver de colas está configurado como `database`. Las tablas `jobs`, `job_batches` y `failed_jobs` ya están migradas.

## Casos de Uso en Finanzas Personales

### Jobs Disponibles (planificados)

1. **GenerateReportJob** — Genera reportes PDF/Excel de transacciones
   - Se dispara desde el controlador de reportes
   - Retorna 202 inmediato; frontend escucha vía Broadcasting cuando termina

2. **SendBudgetAlertJob** — Envía email/notificación cuando se supera el presupuesto
   - Disparado por Observers en el modelo Transaction

3. **ImportTransactionsJob** — Importa transacciones masivas desde CSV/Excel
   - Usa Laravel Streams para manejar archivos grandes sin cargar todo en memoria

---

## Crear un Job

```bash
php artisan make:job GenerateReportJob
```

Estructura básica:

```php
<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateReportJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $timeout = 300; // 5 minutos

    public function __construct(
        private readonly int $userId,
        private readonly string $period
    ) {}

    public function handle(): void
    {
        // Lógica de generación del reporte
        // Usar LazyCollection / cursor() para grandes volúmenes
    }

    public function failed(\Throwable $exception): void
    {
        // Notificar al usuario del fallo
    }
}
```

Disparar el job:

```php
GenerateReportJob::dispatch($userId, $period);
// O con delay:
GenerateReportJob::dispatch($userId, $period)->delay(now()->addSeconds(5));
```

---

## Iniciar Queue Workers

### Opción 1: Desarrollo (Manual)

```bash
php artisan queue:work --tries=3 --timeout=300
```

### Opción 2: Producción (Supervisor)

#### 1. Instalar Supervisor
```bash
sudo apt-get install supervisor
```

#### 2. Copiar configuración
```bash
sudo cp storage/supervisor/laravel-worker.conf /etc/supervisor/conf.d/
```

#### 3. Actualizar y iniciar
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

#### 4. Comandos útiles
```bash
# Ver estado
sudo supervisorctl status

# Reiniciar workers (después de cambios en código)
sudo supervisorctl restart laravel-worker:*

# Detener workers
sudo supervisorctl stop laravel-worker:*

# Ver logs
tail -f storage/logs/worker.log
```

---

## Configuración de Queue Driver

Asegúrate de que tu `.env` tenga:

```env
QUEUE_CONNECTION=database
```

Las tablas `jobs`, `job_batches` y `failed_jobs` ya están migradas.

---

## Ejemplo de Uso — Reporte en Background

### Backend: disparar el job

```php
// En el controlador de reportes:
GenerateReportJob::dispatch(auth()->id(), $request->period);
return $this->successResponse(
    ['message' => 'El reporte se está generando, recibirás una notificación'],
    'Proceso iniciado',
    202
);
```

### Frontend: escuchar el resultado vía Broadcasting

```javascript
window.Echo.private(`user.${userId}`)
  .listen('ReportReady', (event) => {
    // Mostrar enlace de descarga o notificación
    console.log('Reporte listo:', event.downloadUrl);
  });
```

---

## Monitoreo de Jobs

```bash
# Ver jobs en cola
php artisan queue:monitor database

# Ver failed jobs
php artisan queue:failed

# Reintentar un job fallido
php artisan queue:retry <job-id>

# Limpiar failed jobs
php artisan queue:flush

# Ver logs del worker
tail -f storage/logs/laravel.log

# Reiniciar workers (después de deploy)
php artisan queue:restart
```

---

## Opciones Adicionales (Planificado)

- **Laravel Horizon** — Dashboard visual para Redis queues
- **Batch Jobs** — Para importar miles de transacciones en paralelo
- **Rate Limiting** — Limitar jobs pesados por usuario

---

**Referencia:** [CODING-STANDARDS.md → Colas de Trabajo](CODING-STANDARDS.md)
