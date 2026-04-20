# Configuración de Queue Workers con Laravel

## 🚀 Implementación Completada

Se ha implementado un sistema robusto de ejecución de scripts en segundo plano usando Laravel Queue con las siguientes características:

### ✅ Características Implementadas

1. **Jobs en Segundo Plano**
   - `InstallServerJob` - Instala servidor con validación completa
   - `ChangeDomainJob` - Cambia dominio con verificación de exit codes

2. **Validación Robusta**
   - ✅ Verifica conexión SSH antes de ejecutar
   - ✅ Valida permisos de archivos (chmod)
   - ✅ Captura exit codes del script shell
   - ✅ Timeout configurable (30min install, 15min change-domain)
   - ✅ Manejo de errores detallado

3. **Progress Tracking en Tiempo Real**
   - Emite eventos `ServerActionProgress` durante toda la ejecución
   - Actualiza `ServerActivityLog` con estados: queued → in_progress → completed/failed
   - Broadcasting vía Laravel Reverb para mostrar en frontend

4. **HTTP Response Inmediato**
   - Retorna 202 Accepted al encolar el job
   - Frontend recibe `operation_id` para tracking
   - No bloquea la petición HTTP

---

## 📦 Iniciar Queue Workers

### Opción 1: Desarrollo (Manual)

```bash
# Iniciar worker en terminal
php artisan queue:work --tries=1 --timeout=2000

# O usar composer script
composer dev
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

## 🔧 Configuración de Queue Driver

Asegúrate de que tu `.env` tenga:

```env
QUEUE_CONNECTION=database
```

Las tablas `jobs`, `job_batches` y `failed_jobs` ya están migradas.

---

## 📡 Ejemplo de Uso desde Frontend

### 1. Iniciar Instalación

```javascript
const response = await fetch('/api/server/1/install', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    operationId: 'op_123456',
    domain: 'ejemplo.com',
    email: 'admin@ejemplo.com'
  })
});

const data = await response.json();
// Response inmediato:
// {
//   "success": true,
//   "data": {
//     "id": 1,
//     "name": "Server 1",
//     "operation_id": "op_123456",
//     "status": "queued"
//   },
//   "message": "Instalación iniciada en segundo plano"
// }
```

### 2. Escuchar Progreso vía WebSocket (Reverb)

```javascript
// En el frontend, conectar a Laravel Reverb
const echo = new Echo({
  broadcaster: 'reverb',
  key: import.meta.env.VITE_REVERB_APP_KEY,
  wsHost: import.meta.env.VITE_REVERB_HOST,
  wsPort: import.meta.env.VITE_REVERB_PORT,
});

// Escuchar progreso
echo.channel('server-actions')
  .listen('ServerActionProgress', (event) => {
    console.log(event.operationId, event.message, event.progress);
    // Actualizar UI: "Instalando dependencias... 60%"
  })
  .listen('ServerActionComplete', (event) => {
    console.log('Completado!', event.message);
    // Mostrar success notification
  })
  .listen('ServerActionError', (event) => {
    console.error('Error:', event.message);
    // Mostrar error notification
  });
```

---

## 🔍 Monitoreo de Jobs

### Ver jobs en cola
```bash
php artisan queue:monitor database
```

### Ver failed jobs
```bash
php artisan queue:failed
```

### Reintentar failed job
```bash
php artisan queue:retry <job-id>
```

### Limpiar failed jobs
```bash
php artisan queue:flush
```

---

## 🎯 Validaciones Implementadas

### InstallServerJob

1. ✅ Verifica conexión SSH (`echo "test"`)
2. ✅ Crea carpeta de instalación
3. ✅ Valida que carpeta existe (`test -d`)
4. ✅ Sube script correctamente
5. ✅ Valida que archivo se subió (`test -f`)
6. ✅ Aplica permisos (`chmod +x`)
7. ✅ Verifica permisos (`test -x`)
8. ✅ Ejecuta con timeout (`timeout 1500`)
9. ✅ Captura exit code (`echo EXIT_CODE:$?`)
10. ✅ Valida exit code (0 = éxito, 124 = timeout)
11. ✅ Actualiza DB solo si éxito
12. ✅ Broadcast eventos en cada paso

### ChangeDomainJob

1. ✅ Mismas validaciones que InstallServerJob
2. ✅ Timeout de 10 minutos (`timeout 600`)
3. ✅ Valida formato de dominio en controller
4. ✅ Reemplaza variables dinámicamente (old_domain, new_domain, php_version)

---

## 🐛 Debugging

### Ver logs del job
```bash
tail -f storage/logs/laravel.log
```

### Ver output del script shell
El output completo se guarda en:
- Laravel Log: `storage/logs/laravel.log`
- Activity Log: `server_activity_logs.response_data`

### Verificar que el script se ejecutó
```bash
# En el servidor remoto
ls -la /home/tmp/install.sh
cat /home/tmp/install.sh
```

---

## ⚠️ Notas Importantes

1. **Timeout del Job vs Timeout del Script**
   - Job timeout: 1800s (30min) para InstallServerJob
   - Script timeout: 1500s (25min) vía comando `timeout`
   - SSH timeout: 1600s (26min) vía `$ssh->setTimeout()`

2. **Exit Codes Especiales**
   - `0` = Éxito
   - `124` = Timeout del comando `timeout`
   - `> 0` = Error en el script

3. **Reiniciar Workers**
   Después de cambios en código de Jobs:
   ```bash
   sudo supervisorctl restart laravel-worker:*
   # O en desarrollo:
   php artisan queue:restart
   ```

4. **Capacidad**
   - Configuración actual: 2 workers en paralelo
   - Ajustar `numprocs=2` en supervisor config según necesidad

---

## 📊 Estados de ServerActivityLog

- `queued` - Job encolado, esperando procesamiento
- `in_progress` - Job en ejecución (auto-actualizado por el Job)
- `completed` - Finalizado exitosamente
- `failed` - Falló con error

---

## 🎉 Próximos Pasos (Opcional)

1. **Laravel Horizon** (para Redis queue)
   ```bash
   composer require laravel/horizon
   php artisan horizon:install
   ```

2. **Notificaciones por Email/Slack**
   Agregar en método `failed()` de los Jobs

3. **Rate Limiting**
   Limitar instalaciones simultáneas por servidor

4. **Retry Logic**
   Cambiar `$tries = 1` a `$tries = 3` con backoff

---

¡Sistema de Jobs en segundo plano listo para producción! 🚀
