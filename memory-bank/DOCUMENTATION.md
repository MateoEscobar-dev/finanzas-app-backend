# Sistema de Programas Dinámicos - Documentación

## 📋 Conceptos

Este sistema utiliza el patrón **Strategy + Factory** para permitir:

- ✅ Instalación de programas con lógica **centralizada y reutilizable**
- ✅ Extensibilidad: cada programa tiene su **propia clase**
- ✅ Validaciones y configuración **específicas por programa**
- ✅ Pasos antes, durante y después de la instalación
- ✅ Instanciación **dinámica** basada en el slug

## 🏗️ Estructura de Directorios

```
app/Programs/
├── Abstracts/
│   └── AppProgramCreate.php          # Clase base abstracta
├── Factory/
│   └── ProgramFactory.php             # Factory que instancia dinámicamente
└── Implementations/
    ├── BancolombiaProgram.php        # Implementación específica
    ├── BancoPopularProgram.php       # Implementación específica
    ├── OtroProgram.php               # Agregar más programas aquí
    └── ...
```

## 🔧 Cómo Funciona

### 1. Factory - Instanciación Dinámica

El slug del programa se convierte automáticamente a nombre de clase:

```
bancolombia           → BancolombiaProgram
banco-popular         → BancoPopularProgram
mi-programa-especial  → MiProgramaEspecialProgram
```

### 2. Clase Base - Lógica Compartida

`AppProgramCreate` proporciona:

- Validación de compatibilidad
- Ciclo de vida de instalación
- Logging y broadcasting en tiempo real
- Manejo de errores
- Respuesta estructurada

### 3. Subclases - Lógica Específica

Cada programa extiende `AppProgramCreate` e implementa:

```php
class MiProgramaProgram extends AppProgramCreate
{
    protected function isCompatibleWithServer(): bool { }
    protected function beforeInstall(): void { }
    protected function install(): void { }      // ← OBLIGATORIO
    protected function afterInstall(): void { }
}
```

## 📝 Ejemplo: Crear un Nuevo Programa

### Paso 1: Crear la clase

```php
<?php

namespace App\Programs\Implementations;

use App\Programs\Abstracts\AppProgramCreate;

class MiProgramaProgram extends AppProgramCreate
{
    protected function isCompatibleWithServer(): bool
    {
        if ($this->server->operatingSystem->slug !== 'linux') {
            throw new \Exception("MiPrograma requiere Linux");
        }
        return true;
    }

    protected function beforeInstall(): void
    {
        parent::beforeInstall();
        $this->logProgress("Descargando dependencias...");
    }

    protected function install(): void
    {
        $this->logProgress("Instalando MiPrograma...");
        
        $this->executeServerCommand("wget https://repo.example.com/mi-programa.tar.gz");
        $this->executeServerCommand("tar -xzf mi-programa.tar.gz");
        
        $this->setResponseData([
            'program' => 'MiPrograma',
            'version' => '1.0.0',
            'status' => 'installed',
        ]);
    }

    protected function afterInstall(): void
    {
        parent::afterInstall();
        $this->logProgress("Iniciando servicios...");
        $this->executeServerCommand("systemctl start mi-programa");
    }
}
```

Archivo: `app/Programs/Implementations/MiProgramaProgram.php`

### Paso 2: Usar en el Controller

```php
// El Factory se encarga automáticamente de instanciar MiProgramaProgram
// basándose en el slug "mi-programa"
$programInstaller = ProgramFactory::create($server, $program, $operationId);
$responseData = $programInstaller->getResponseData();
```

## 🎯 Métodos Disponibles en la Clase Base

### Métodos a Override

| Método | Obligatorio | Descripción |
|--------|-----------|-------------|
| `install()` | ✅ SÍ | Implementación principal |
| `isCompatibleWithServer()` | ❌ No | Validar compatibilidad |
| `beforeInstall()` | ❌ No | Pasos previos |
| `afterInstall()` | ❌ No | Pasos posteriores |
| `execute()` | ❌ No | Cambiar el flujo completo |

### Métodos Disponibles

```php
// Registrar progreso y transmitir eventos en tiempo real
$this->logProgress("Mensaje", ['key' => 'value']);

// Ejecutar comandos en el servidor SSH
$result = $this->executeServerCommand("comando aquí");

// Establecer datos de respuesta (se devuelven al cliente)
$this->setResponseData(['key' => 'value']);

// Obtener datos de respuesta
$data = $this->getResponseData();

// Acceso a propiedades
$this->server;          // El servidor (Server model)
$this->program;         // El programa (ServerAvailablePrograms model)
$this->operationId;     // ID único de la operación
```

## 🚨 Manejo de Errores

Si el programa no existe:

```
Exception: Programa no soportado: No existe la clase 'MiProgramaProgram' 
           para el programa 'mi-programa'
```

## 📡 Eventos Transmitidos

Durante la instalación, se transmiten eventos WebSocket en tiempo real:

```php
// Progreso
broadcast(new ServerActionProgress($operationId, $message, $details));

// Completado
broadcast(new ServerActionComplete($operationId, $message));

// Error
broadcast(new ServerActionError($operationId, $message, 'ERROR_CODE'));
```

## 💡 Ejemplo de Flujo Completo

```
POST /api/server/1/add-program
{
    "programId": 5,
    "operationId": "op_abc123"
}

↓ Factory instancia BancoPopularProgram
↓ Constructor llama execute()
↓ beforeInstall() → Actualizar repositorios, instalar dependencias
↓ install() → Descargar, extraer, instalar programa
↓ afterInstall() → Iniciar servicios, health checks
↓ completeOperation() → Marcar como completado
↓ broadcast() → Notificar al cliente

Response:
{
    "success": true,
    "message": "Programa BancoPopular agregado correctamente",
    "data": {
        "program": "BancoPopular",
        "installation_path": "/opt/banco-popular",
        "status": "installed",
        "version": "2.0.0"
    }
}
```

## 🔍 Testing

```php
// Probar validación de compatibilidad
$this->assertThrows('Linux required', function () {
    ProgramFactory::create($server, $program, 'op_123');
});

// Probar que la clase existe
$this->assertTrue(class_exists('App\\Programs\\Implementations\\BancolombiaProgram'));
```

## 📚 Extensiones Avanzadas

### Override del flujo completo

```php
protected function execute(): void
{
    $this->logProgress("Ejecutando secuencia personalizada...");
    
    $this->step1();
    $this->step2();
    $this->step3();
    
    $this->completeOperation();
}
```

### Métodos auxiliares personalizados

```php
private function downloadInstaller(): string
{
    $result = $this->executeServerCommand("wget ...");
    return $result['output'];
}

private function validateInstallation(): bool
{
    $result = $this->executeServerCommand("./test.sh");
    return $result['success'];
}
```

---

**Creado:** 2026-01-22 | **Versión:** 1.0
