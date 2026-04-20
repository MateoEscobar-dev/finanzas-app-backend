# Laravel Reverb - Guía de Instalación y Configuración

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

Las variables de entorno ya están configuradas en [.env](.env):

```env
BROADCAST_CONNECTION=reverb

# Laravel Reverb WebSocket
REVERB_APP_ID=8ec0bd6c-8bae-4162-a0ed-13e6ac52cd98
REVERB_APP_KEY=e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346
REVERB_APP_SECRET=607c3dcd5b2267c274d27826a2ca69f5d9ff8d4706c0d9344adf8d3f791730a2
REVERB_HOST=paneladmin.local
REVERB_PORT=6001
REVERB_SCHEME=http
```

### Configuración de Broadcasting

El archivo [config/broadcasting.php](config/broadcasting.php) ya está configurado para usar `reverb` como broadcaster por defecto.

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

En tu aplicación frontend (React/Vue/etc), necesitas configurar Laravel Echo para conectarse a Reverb:

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
    key: "e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346",
    wsHost: "paneladmin.local",
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});
```

### 3. Escuchar eventos de servidor

```javascript
const operationId = "op_1705595400000_a1b2c3";

// Suscribirse al canal de la operación
window.Echo.channel(`server-actions.${operationId}`)
    .listen(".progress", (event) => {
        console.log("Progress:", event);
        // event.message, event.progress, event.severity
    })
    .listen(".complete", (event) => {
        console.log("Complete:", event);
        // event.message
    })
    .listen(".error", (event) => {
        console.error("Error:", event);
        // event.message, event.errorCode
    });
```

## Estructura de Eventos WebSocket

### Evento: Progress

```json
{
    "type": "progress",
    "operationId": "op_1705595400000_a1b2c3",
    "message": "Conectando al servidor...",
    "severity": "info",
    "progress": 10,
    "timestamp": "2026-01-18T10:30:15.000Z"
}
```

### Evento: Complete

```json
{
    "type": "complete",
    "operationId": "op_1705595400000_a1b2c3",
    "message": "Operación completada correctamente",
    "severity": "success",
    "progress": 100,
    "timestamp": "2026-01-18T10:32:45.000Z"
}
```

### Evento: Error

```json
{
    "type": "error",
    "operationId": "op_1705595400000_a1b2c3",
    "message": "Error: No se puede conectar al servidor",
    "severity": "error",
    "progress": 30,
    "errorCode": "CONNECTION_TIMEOUT",
    "timestamp": "2026-01-18T10:31:20.000Z"
}
```

## Endpoints Implementados

### 1. Validar Estado del Servidor

```bash
POST /api/server/{id}/validate-status
Content-Type: application/json

{
  "operationId": "op_1705595400000_a1b2c3"
}
```

### 2. Instalar Servidor

```bash
POST /api/server/{id}/install
Content-Type: application/json

{
  "domain": "nuevo.ejemplo.com",
  "email": "admin@ejemplo.com",
  "operationId": "op_1705595400000_a1b2c3"
}
```

### 3. Agregar Programa

```bash
POST /api/server/{id}/add-program
Content-Type: application/json

{
  "programId": 5,
  "operationId": "op_1705595400000_a1b2c3"
}
```

### 4. Cambiar Dominio

```bash
POST /api/server/{id}/change-domain
Content-Type: application/json

{
  "newDomain": "nuevo-dominio.com",
  "operationId": "op_1705595400000_a1b2c3"
}
```

### 5. Desactivar Servicio

```bash
POST /api/server/{id}/deactivate-service
Content-Type: application/json

{
  "operationId": "op_1705595400000_a1b2c3"
}
```

### 6. Activar Servicio

```bash
POST /api/server/{id}/activate-service
Content-Type: application/json

{
  "operationId": "op_1705595400000_a1b2c3"
}
```

### 7. Programas Disponibles

```bash
GET /api/servers/available-programs
```

## Ejecutar con Supervisor (Producción)

Crear archivo `/etc/supervisor/conf.d/reverb.conf`:

```ini
[program:reverb]
command=php /var/www/html/panel_admin/back_api_panel_admin/artisan reverb:start --host=0.0.0.0 --port=8080
directory=/var/www/html/panel_admin/back_api_panel_admin
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/var/log/supervisor/reverb.log
```

Luego:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start reverb
```

## Logs y Auditoría

Todos los eventos se registran en la tabla `server_activity_logs`:

- `operation_id`: ID único de la operación
- `server_id`: ID del servidor
- `action`: Acción ejecutada (validate-status, install, etc.)
- `user_id`: Usuario que ejecutó la acción
- `status`: pending, in_progress, completed, failed
- `request_data`: Datos de la petición (JSON)
- `response_data`: Datos de la respuesta (JSON)
- `error_message`: Mensaje de error si falla
- `started_at`: Fecha de inicio
- `completed_at`: Fecha de finalización

## Troubleshooting

### El servidor WebSocket no inicia

```bash
# Verificar si el puerto está en uso
sudo netstat -tlnp | grep 8080

# Verificar logs de Laravel
tail -f storage/logs/laravel.log
```

### Frontend no se conecta

1. Verificar que Reverb esté corriendo
2. Verificar firewall/puertos
3. Verificar que las credenciales en frontend coincidan con `.env`

### Eventos no se reciben

1. Verificar que el `operationId` sea correcto
2. Verificar en logs de Laravel que los eventos se estén disparando
3. Usar debug mode: `php artisan reverb:start --debug`

## Testing con Postman

1. Hacer POST a cualquier endpoint con `operationId`
2. Abrir WebSocket connection en otra pestaña: `ws://127.0.0.1:8080`
3. Enviar mensaje de suscripción:

```json
{
    "event": "pusher:subscribe",
    "data": {
        "channel": "server-actions.op_1705595400000_a1b2c3"
    }
}
```

4. Observar los eventos en tiempo real

## Notas Importantes

1. **Seguridad**: En producción, usar `wss://` (HTTPS) y configurar certificados SSL
2. **Autenticación**: Los endpoints requieren autenticación JWT
3. **Permisos**: Verificar que el usuario tenga permisos para ejecutar acciones en servidores
4. **Rate Limiting**: Máximo 10 operaciones por usuario por minuto
5. **Scripts**: Los scripts `install.sh` y `change-domain.sh` deben estar en `storage/app/sh/`
6. **SSH**: La conexión SSH usa phpseclib3, las contraseñas se desencriptan con Laravel Crypt
