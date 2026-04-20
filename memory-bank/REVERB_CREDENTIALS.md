# 🔐 Configuración de Credenciales Laravel Reverb

## ⚠️ IMPORTANTE: NO Requiere Registro Externo

**Laravel Reverb NO es como Pusher**. No necesitas registrarte en ningún sitio web ni obtener credenciales de un servicio externo. Las credenciales se generan localmente y solo deben coincidir entre backend y frontend.

## 🔑 Credenciales Generadas (Ya configuradas en .env)

```env
REVERB_APP_ID=8ec0bd6c-8bae-4162-a0ed-13e6ac52cd98
REVERB_APP_KEY=e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346
REVERB_APP_SECRET=607c3dcd5b2267c274d27826a2ca69f5d9ff8d4706c0d9344adf8d3f791730a2
REVERB_HOST=paneladmin.local
REVERB_PORT=6001
REVERB_SCHEME=http
```

Estas credenciales fueron generadas usando:

- `REVERB_APP_ID`: UUID aleatorio
- `REVERB_APP_KEY`: Hash seguro de 64 caracteres (openssl rand -hex 32)
- `REVERB_APP_SECRET`: Hash seguro de 64 caracteres (openssl rand -hex 32)

## 📝 Configuración del Frontend

### ❌ INCORRECTO (Configuración antigua de Pusher)

```javascript
this.echo = new Echo({
    broadcaster: "reverb",
    key: "a2d3bd8596bbfc12f10d", // ❌ Esta es una key de Pusher
    wsHost: "paneladmin.local",
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});
```

### ✅ CORRECTO (Configuración de Laravel Reverb)

```javascript
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: "e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346", // ✅ Usar REVERB_APP_KEY del .env
    wsHost: "paneladmin.local", // ✅ Mismo que REVERB_HOST
    wsPort: 6001, // ✅ Mismo que REVERB_PORT
    wssPort: 6001,
    forceTLS: false, // ✅ false porque usamos http (REVERB_SCHEME=http)
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});
```

## 🔄 Variables de Entorno para Frontend

Si usas variables de entorno en tu frontend (React con Vite, Next.js, etc.):

### React con Vite (.env en frontend)

```env
VITE_REVERB_APP_KEY=e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346
VITE_REVERB_HOST=paneladmin.local
VITE_REVERB_PORT=6001
VITE_REVERB_SCHEME=http
```

Uso en código:

```javascript
window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: import.meta.env.VITE_REVERB_SCHEME === "https",
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});
```

### Next.js (.env.local en frontend)

```env
NEXT_PUBLIC_REVERB_APP_KEY=e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346
NEXT_PUBLIC_REVERB_HOST=paneladmin.local
NEXT_PUBLIC_REVERB_PORT=6001
NEXT_PUBLIC_REVERB_SCHEME=http
```

Uso en código:

```javascript
window.Echo = new Echo({
    broadcaster: "reverb",
    key: process.env.NEXT_PUBLIC_REVERB_APP_KEY,
    wsHost: process.env.NEXT_PUBLIC_REVERB_HOST,
    wsPort: parseInt(process.env.NEXT_PUBLIC_REVERB_PORT),
    wssPort: parseInt(process.env.NEXT_PUBLIC_REVERB_PORT),
    forceTLS: process.env.NEXT_PUBLIC_REVERB_SCHEME === "https",
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});
```

## 🚀 Iniciar Laravel Reverb

```bash
cd /var/www/html/panel_admin/back_api_panel_admin

# Iniciar servidor WebSocket en puerto 6001
php artisan reverb:start --host=0.0.0.0 --port=6001 --debug
```

**Nota**: Usa `--host=0.0.0.0` para permitir conexiones externas (desde el frontend).

## 🧪 Verificar Conexión

### 1. Verificar que Reverb esté corriendo

```bash
# Ver si el puerto 6001 está en uso
sudo netstat -tlnp | grep 6001

# Debería mostrar algo como:
# tcp  0  0  0.0.0.0:6001  0.0.0.0:*  LISTEN  12345/php
```

### 2. Test desde navegador (consola)

```javascript
// Conectar
window.Echo.connector.pusher.connection.bind("connected", () => {
    console.log("✅ Conectado a Reverb");
});

window.Echo.connector.pusher.connection.bind("error", (err) => {
    console.error("❌ Error de conexión:", err);
});

// Suscribirse a canal de prueba
const operationId = "test-123";
window.Echo.channel(`server-actions.${operationId}`)
    .listen(".progress", (e) => console.log("Progress:", e))
    .listen(".complete", (e) => console.log("Complete:", e))
    .listen(".error", (e) => console.error("Error:", e));
```

### 3. Test desde backend (trigger manual)

```bash
php artisan tinker

# En tinker:
use App\Events\ServerActionProgress;
broadcast(new ServerActionProgress('test-123', 'Mensaje de prueba', 'info', 50));
exit
```

Si ves el mensaje en la consola del navegador, ¡funciona! 🎉

## 🔒 Seguridad en Producción

### 1. Cambiar a HTTPS/WSS

```env
REVERB_SCHEME=https
REVERB_PORT=443  # o el puerto SSL que uses
```

Frontend:

```javascript
window.Echo = new Echo({
    broadcaster: "reverb",
    key: "e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346",
    wsHost: "paneladmin.local",
    wsPort: 443,
    wssPort: 443,
    forceTLS: true, // ✅ true para HTTPS
    enabledTransports: ["wss"], // Solo WSS en producción
    disableStats: true,
});
```

### 2. Configurar Nginx/Apache como proxy

#### Nginx

```nginx
location /reverb {
    proxy_pass http://localhost:6001;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "Upgrade";
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
}
```

### 3. Usar Supervisor para auto-restart

```ini
[program:reverb]
command=php /var/www/html/panel_admin/back_api_panel_admin/artisan reverb:start --host=0.0.0.0 --port=6001
directory=/var/www/html/panel_admin/back_api_panel_admin
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/var/log/supervisor/reverb.log
```

## ❓ Preguntas Frecuentes

### ¿Por qué mi frontend no se conecta?

1. **Verificar que Reverb esté corriendo**

    ```bash
    ps aux | grep reverb
    ```

2. **Verificar firewall**

    ```bash
    sudo ufw allow 6001/tcp
    ```

3. **Verificar que la key coincida**
    - Backend: `REVERB_APP_KEY` en `.env`
    - Frontend: `key` en configuración de Echo

4. **Verificar host**
    - Si frontend y backend están en diferentes dominios, usar IP o dominio accesible
    - Iniciar Reverb con `--host=0.0.0.0` no `127.0.0.1`

### ¿Puedo cambiar las credenciales después?

Sí, solo necesitas:

1. Cambiar en `backend/.env`
2. Cambiar en configuración de Echo del frontend
3. Reiniciar Reverb: `php artisan reverb:restart`

### ¿Son seguras estas credenciales?

Sí, son hashes aleatorios de 64 caracteres generados con OpenSSL. En producción:

- Usa HTTPS/WSS
- Restringe acceso por firewall
- Usa autenticación para canales privados (si es necesario)

## 📊 Resumen de Cambios

### Backend (.env)

```env
REVERB_APP_ID=8ec0bd6c-8bae-4162-a0ed-13e6ac52cd98
REVERB_APP_KEY=e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346
REVERB_APP_SECRET=607c3dcd5b2267c274d27826a2ca69f5d9ff8d4706c0d9344adf8d3f791730a2
REVERB_HOST=paneladmin.local
REVERB_PORT=6001
REVERB_SCHEME=http
```

### Frontend (cambiar en tu código)

```javascript
// ANTES (Pusher)
key: "a2d3bd8596bbfc12f10d";

// DESPUÉS (Reverb)
key: "e2f77098de874a4890557afd5b068b65040b8f7ccc30280beec56d361749d346";
```

### Comando para iniciar

```bash
php artisan reverb:start --host=0.0.0.0 --port=6001 --debug
```

---

## 🎉 ¡Listo!

Con estos cambios, tu frontend y backend estarán sincronizados. Recuerda:

1. ✅ Credenciales generadas localmente (no requiere registro)
2. ✅ La `key` del frontend debe coincidir con `REVERB_APP_KEY` del backend
3. ✅ Host y puerto deben coincidir
4. ✅ Iniciar Reverb con `--host=0.0.0.0` para permitir conexiones externas

¿Dudas? Revisa los logs:

```bash
# Backend logs
tail -f storage/logs/laravel.log

# Reverb logs (si lo corriste con --debug)
# Se muestran en la terminal donde ejecutaste reverb:start
```
