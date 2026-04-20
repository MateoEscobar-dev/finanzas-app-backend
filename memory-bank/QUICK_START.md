# 🚀 Guía Rápida - Queue Worker & WebSocket

## Para DESARROLLO (Testing Local)

### Un solo comando:
```bash
./start-dev.sh
```
O también:
```bash
composer dev
```

Esto inicia:
- ✅ Queue Worker (procesa jobs en segundo plano)
- ✅ Laravel Reverb (WebSocket en puerto 6001)

**Para detener:** Presiona `Ctrl+C`

---

## Para PRODUCCIÓN (Servidor)

### 1️⃣ Primera vez (Instalación):
```bash
sudo ./setup-production.sh
```

Esto instala y configura automáticamente:
- ✅ Supervisor
- ✅ Queue Worker (2 workers en paralelo)
- ✅ Laravel Reverb
- ✅ Inicio automático al arrancar servidor
- ✅ Reinicio automático si falla

### 2️⃣ Control diario:
```bash
# Ver estado
sudo ./production-control.sh status

# Reiniciar (después de cambios en código)
sudo ./production-control.sh restart

# Ver logs en tiempo real
sudo ./production-control.sh logs

# Detener
sudo ./production-control.sh stop

# Iniciar
sudo ./production-control.sh start
```

---

## 🧪 Probar que funciona

### 1. Inicia los servicios (desarrollo o producción)

### 2. Haz una petición:
```bash
curl -X POST http://localhost/api/server/1/install \
  -H "Content-Type: application/json" \
  -d '{
    "operationId": "test_123",
    "domain": "test.com",
    "email": "test@test.com"
  }'
```

### 3. Verás en los logs:
```
[2026-01-21 10:30:00] Processing: App\Jobs\InstallServerJob
[2026-01-21 10:30:05] Conectando al servidor...
[2026-01-21 10:30:10] Verificando conexión SSH...
...
[2026-01-21 10:35:00] Processed: App\Jobs\InstallServerJob
```

### 4. El frontend recibirá eventos WebSocket en tiempo real:
```javascript
ServerActionProgress: "Instalando... 40%"
ServerActionProgress: "Configurando... 70%"
ServerActionComplete: "¡Completado!"
```

---

## 📊 Diferencias

| Aspecto | Desarrollo | Producción |
|---------|-----------|------------|
| **Comando** | `./start-dev.sh` | `sudo ./setup-production.sh` (una vez) |
| **Terminal** | Necesita terminal abierta | Corre en background |
| **Logs** | Se ven en terminal | `sudo ./production-control.sh logs` |
| **Al reiniciar PC** | Hay que iniciar manual | Se inicia automático |
| **Workers** | 1 worker | 2 workers en paralelo |
| **Gestión** | Ctrl+C para detener | `sudo ./production-control.sh` |

---

## ❓ Solución de Problemas

### "No procesa los jobs"
```bash
# Verifica que el worker esté corriendo
ps aux | grep queue:work

# Si no está, inícialo
./start-dev.sh  # desarrollo
# o
sudo ./production-control.sh start  # producción
```

### "WebSocket no conecta"
```bash
# Verifica que Reverb esté corriendo
ps aux | grep reverb:start

# Verifica el puerto
netstat -tlnp | grep 6001
```

### "Después de cambios en código no funciona"
```bash
# Desarrollo: Ctrl+C y volver a iniciar
./start-dev.sh

# Producción: Reiniciar servicios
sudo ./production-control.sh restart
```

---

## 🎯 Checklist Rápido

### Desarrollo:
- [x] `./start-dev.sh` corriendo
- [x] Ver logs en terminal
- [x] Hacer petición de prueba
- [x] Verificar que procesa el job

### Producción:
- [x] `sudo ./setup-production.sh` (solo primera vez)
- [x] `sudo ./production-control.sh status` → todo RUNNING
- [x] Hacer petición de prueba
- [x] `sudo ./production-control.sh logs` → ver que procesa

---

¡Listo! Todo configurado para funcionar con comandos simples. 🎉
