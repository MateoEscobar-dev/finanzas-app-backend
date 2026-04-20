# Laravel Reverb — Guía de Instalación y Configuración

> Broadcasting en tiempo real para la app de finanzas personales.
> Casos de uso: alertas de presupuesto, notificaciones de reporte listo, sincronización multi-dispositivo.

## Instalación

### 1. Instalar Laravel Reverb

```bash
composer require laravel/reverb
```

### 2. Publicar configuración

```bash
php artisan reverb:install
```

Este comando creará:

- El archivo de configuración `config/reverb.php`
- Agregará las variables de entorno necesarias en `.env`

## Configuración

Variables de entorno en `.env`:

```env
BROADCAST_CONNECTION=reverb

# Laravel Reverb WebSocket
REVERB_APP_ID=<genera con: cat /proc/sys/kernel/random/uuid>
REVERB_APP_KEY=<genera con: openssl rand -hex 32>
REVERB_APP_SECRET=<genera con: openssl rand -hex 32>
REVERB_HOST=finanzas.local
REVERB_PORT=6001
REVERB_SCHEME=http
```

> Ver [REVERB_CREDENTIALS.md](REVERB_CREDENTIALS.md) para detalles sobre cómo generar y sincronizar credenciales con el frontend.

### Configuración de Broadcasting

El archivo `config/broadcasting.php` debe tener `reverb` como broadcaster por defecto.

## Iniciar el Servidor WebSocket

### Modo Desarrollo

```bash
php artisan reverb:start
```

### Modo Desarrollo con Debug

```bash
php artisan reverb:start --debug
```

### Modo Producción

```bash
php artisan reverb:start --host=0.0.0.0 --port=6001
```

## Configuración del Frontend

### 1. Instalar dependencias

```bash
npm install --save-dev laravel-echo pusher-js
```

### 2. Configurar Echo

```javascript
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,   // finanzas.local
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: import.meta.env.VITE_REVERB_SCHEME === "https",
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});
```

### 3. Escuchar eventos de finanzas

```javascript
// Canal privado del usuario autenticado
window.Echo.private(`user.${userId}`)
    .listen("BudgetAlert", (event) => {
        // event.category, event.percentage, event.message
        showNotification(`Alerta: ${event.message}`);
    })
    .listen("ReportReady", (event) => {
        // event.downloadUrl, event.reportType
        showDownloadButton(event.downloadUrl);
    });
```

## Estructura de Eventos de Finanzas

### Evento: BudgetAlert

```json
{
    "userId": 1,
    "category": "Comida",
    "budgetAmount": 500000,
    "spentAmount": 420000,
    "percentage": 84,
    "message": "Has usado el 84% de tu presupuesto en Comida",
    "timestamp": "2026-04-20T10:30:00.000Z"
}
```

### Evento: ReportReady

```json
{
    "userId": 1,
    "reportType": "monthly",
    "period": "2026-04",
    "downloadUrl": "/api/reports/download/abc123",
    "timestamp": "2026-04-20T10:35:00.000Z"
}
```

## Canales por Usar en Finanzas Personales

| Canal | Tipo | Propósito |
|-------|------|-----------|
| `user.{id}` | Privado | Notificaciones personales del usuario |
| `finance.{userId}` | Privado | Actualizaciones de balance en tiempo real |

## Producción — Supervisor

```ini
[program:reverb]
command=php /var/www/html/finanzas/finanzas-app-backend/artisan reverb:start --host=0.0.0.0 --port=6001
directory=/var/www/html/finanzas/finanzas-app-backend
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/var/log/supervisor/reverb.log
```

## Referencia

- [REVERB_CREDENTIALS.md](REVERB_CREDENTIALS.md) — Credenciales y sincronización con frontend
- [CODING-STANDARDS.md → Broadcasting](CODING-STANDARDS.md) — Patrones de uso en el proyecto

## Iniciar el Servidor WebSocket

### Modo Desarrollo

```bash
php artisan reverb:start
```

### Modo Desarrollo con Debug

```bash
php artisan reverb:start --debug
```

### Modo Producción

```bash
php artisan reverb:start --host=0.0.0.0 --port=6001
```

## Referencia

- [REVERB_CREDENTIALS.md](REVERB_CREDENTIALS.md) — Credenciales y sincronización con frontend
- [CODING-STANDARDS.md → Broadcasting](CODING-STANDARDS.md) — Patrones de uso en el proyecto
