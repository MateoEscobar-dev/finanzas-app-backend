# 💻 Referencia Rápida de Sintaxis

## 🔥 Cheat Sheet - Lo Más Importante

### Crear un Programa (Template Mínimo)

```php
<?php

namespace App\Programs\Implementations;

use App\Programs\Abstracts\AppProgramCreate;

class MiProgramaProgram extends AppProgramCreate
{
    // OBLIGATORIO
    protected function install(): void
    {
        $this->logProgress("Instalando...");
        $this->executeServerCommand("apt-get install mi-programa");
        $this->setResponseData(['status' => 'installed']);
    }
}
```

**Archivo:** `app/Programs/Implementations/MiProgramaProgram.php`

### Métodos Disponibles en la Clase Base

```php
// LOGGING (transmite en tiempo real)
$this->logProgress("Mensaje");
$this->logProgress("Mensaje", ['key' => 'value']);

// COMANDOS SSH
$result = $this->executeServerCommand("comando aquí");
// Devuelve: ['success' => true/false, 'output' => 'output']

// DATOS DE RESPUESTA
$this->setResponseData(['key' => 'value']);
$data = $this->getResponseData();

// PROPIEDADES
$this->server;          // Server model
$this->program;         // ServerAvailablePrograms model
$this->operationId;     // string (único)
$this->responseData;    // array
```

### Hooks Disponibles (Opcionales)

```php
// 1. Validar compatibilidad (OVERRIDE si lo necesitas)
protected function isCompatibleWithServer(): bool
{
    if (!$valid) throw new \Exception("Mensaje de error");
    return true;
}

// 2. Pasos previos (OVERRIDE si lo necesitas)
protected function beforeInstall(): void
{
    parent::beforeInstall();
    // Tu lógica aquí
}

// 3. Instalación PRINCIPAL (OBLIGATORIO - SIEMPRE override)
protected function install(): void
{
    // Tu lógica aquí
}

// 4. Pasos posteriores (OVERRIDE si lo necesitas)
protected function afterInstall(): void
{
    parent::afterInstall();
    // Tu lógica aquí
}

// 5. Override completo del flujo (avanzado, raro)
protected function execute(): void
{
    // TODO: flujo personalizado completo
    $this->completeOperation();
}
```

### Slug → Clase (Conversión Automática)

| Slug en BD | Clase Generada | Archivo |
|-----------|----------------|---------|
| `bancolombia` | `BancolombiaProgram` | `BancolombiaProgram.php` |
| `banco-popular` | `BancoPopularProgram` | `BancoPopularProgram.php` |
| `demo` | `DemoProgram` | `DemoProgram.php` |
| `mi-programa` | `MiProgramaProgram` | `MiProgramaProgram.php` |

## 🎯 Patrones Comunes

### Patrón 1: Programa Simple

```php
class SimpleProgram extends AppProgramCreate
{
    protected function install(): void
    {
        $this->logProgress("Instalando...");
        $this->executeServerCommand("apt-get install simple");
        $this->setResponseData(['status' => 'installed']);
    }
}
```

### Patrón 2: Con Validación

```php
class ValidatedProgram extends AppProgramCreate
{
    protected function isCompatibleWithServer(): bool
    {
        if ($this->server->ram < 4) {
            throw new \Exception("Requiere 4GB RAM");
        }
        return true;
    }

    protected function install(): void
    {
        $this->logProgress("Instalando...");
        $this->executeServerCommand("apt-get install programa");
        $this->setResponseData(['status' => 'installed']);
    }
}
```

### Patrón 3: Con Preparación

```php
class PreparedProgram extends AppProgramCreate
{
    protected function beforeInstall(): void
    {
        parent::beforeInstall();
        $this->logProgress("Preparando...");
        $this->executeServerCommand("apt-get update");
        $this->executeServerCommand("apt-get install -y dependencia");
    }

    protected function install(): void
    {
        $this->logProgress("Instalando...");
        $this->executeServerCommand("apt-get install programa");
        $this->setResponseData(['status' => 'installed']);
    }
}
```

### Patrón 4: Con Pasos Posteriores

```php
class PostProgram extends AppProgramCreate
{
    protected function install(): void
    {
        $this->logProgress("Instalando...");
        $this->executeServerCommand("apt-get install programa");
        $this->setResponseData(['status' => 'installed']);
    }

    protected function afterInstall(): void
    {
        parent::afterInstall();
        $this->logProgress("Iniciando servicios...");
        $this->executeServerCommand("systemctl start programa");
        $this->executeServerCommand("systemctl enable programa");
    }
}
```

### Patrón 5: Múltiples Pasos

```php
class ComplexProgram extends AppProgramCreate
{
    private function paso1() { /* ... */ }
    private function paso2() { /* ... */ }
    private function paso3() { /* ... */ }

    protected function install(): void
    {
        $this->paso1();
        $this->paso2();
        $this->paso3();
    }
}
```

## 📡 Broadcasting

Los eventos se transmiten automáticamente:

```javascript
// Cliente JavaScript
Echo.channel(`server-action.${operationId}`)
    .listen('ServerActionProgress', (event) => {
        console.log(event.message); // "Instalando..."
    })
    .listen('ServerActionComplete', (event) => {
        console.log("✓ Completado");
    })
    .listen('ServerActionError', (event) => {
        console.log("✗ Error: " + event.message);
    });
```

## 🔍 Debugging

### Ver qué está pasando

```bash
# Terminal 1: Ver logs en tiempo real
tail -f storage/logs/laravel.log

# Terminal 2: Ejecutar comando
curl -X POST http://localhost:8000/api/server/1/add-program \
  -H "Content-Type: application/json" \
  -d '{"programId": 5}'
```

### Ver en BD

```sql
SELECT * FROM server_activity_logs 
WHERE operation_id = 'op_xxx';

-- Ver error específico
SELECT error_message FROM server_activity_logs 
WHERE status = 'failed' 
ORDER BY completed_at DESC 
LIMIT 1;
```

## 🧪 Testing Rápido

```bash
# Ejecutar todos
php artisan test tests/Feature/Programs/

# Ejecutar uno específico
php artisan test tests/Feature/Programs/ProgramFactoryTest.php::factory_instancia_correctamente_la_clase_bancolombia

# Ver output
php artisan test tests/Feature/Programs/ -v
```

## ⚙️ Configuración

### En ServerController

```php
use App\Programs\Factory\ProgramFactory;

// Ya hecho, pero así se usa:
$installer = ProgramFactory::create($server, $program, $operationId);
$data = $installer->getResponseData();
```

### Models Requeridos

```php
// app/Models/Server.php
class Server extends Model { }

// app/Models/ServerAvailablePrograms.php
class ServerAvailablePrograms extends Model { }

// app/Models/ServerActivityLog.php
class ServerActivityLog extends Model { }
```

## 🚨 Excepciones Comunes

| Error | Causa | Solución |
|-------|-------|----------|
| "Clase no encontrada" | Archivo no existe | Crear en `Implementations/` |
| "Debe extender AppProgramCreate" | Herencia incorrecta | Agregar `extends AppProgramCreate` |
| "Requiere 4GB" | Server no valida reqs | Override `isCompatibleWithServer()` |
| "SSH Error" | Conexión fallida | Verificar credenciales SSH |
| "Status pending" | Error en ejecución | Ver `error_message` en BD |

## 📝 Respuesta del API

```json
{
  "success": true,
  "message": "Programa MiPrograma agregado correctamente",
  "data": {
    "status": "installed",
    "program": "MiPrograma",
    "version": "1.0.0",
    "path": "/opt/mi-programa"
  }
}
```

## 🔄 Flujo Completo

```
1. POST /api/server/{id}/add-program
   ↓
2. ServerController::addProgram()
   ↓
3. ProgramFactory::create($server, $program, $operationId)
   ↓
4. new MiProgramaProgram($server, $program, $operationId)
   ↓
5. Constructor → execute()
   ├─ validateProgram()
   ├─ beforeInstall()
   ├─ install() ← TÚ IMPLEMENTAS AQUÍ
   ├─ afterInstall()
   └─ completeOperation()
   ↓
6. broadcast(ServerActionComplete)
   ↓
7. return successResponse()
```

## 📊 Conversión de Nombres

```
Script: convertSlugToClassName()

Input:  "banco-popular"
Steps:
  1. Reemplazar "-" y "_" por espacios → "banco popular"
  2. Aplicar ucwords() → "Banco Popular"
  3. Remover espacios → "BancoPopular"
  4. Agregar sufijo → "BancoPopularProgram"
Output: "BancoPopularProgram"
```

## 🎯 Resumen Mínimo

Para crear un programa que instale un paquete:

```php
<?php
namespace App\Programs\Implementations;
use App\Programs\Abstracts\AppProgramCreate;

class MiProgramaProgram extends AppProgramCreate
{
    protected function install(): void
    {
        $this->logProgress("Instalando MiPrograma...");
        $this->executeServerCommand("apt-get install mi-programa");
        $this->setResponseData(['status' => 'installed']);
    }
}
```

**Eso es todo lo que necesitas.** El resto lo hace la clase base.

---

**Referencia:** 2026-01-22 | **Versión:** 1.0
