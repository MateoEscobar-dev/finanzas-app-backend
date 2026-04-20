# 🚀 Sistema de Programas Dinámicos - Quick Start

## ¿Qué es esto?

Un sistema extensible para instalar programas (Bancolombia, BancoPopular, etc.) en servidores de forma **dinámica, reutilizable y mantenible**.

## 🎯 Ventajas

- ✅ **Cada programa tiene su clase propia** → Fácil de mantener
- ✅ **Lógica compartida en base clase** → No repetir código
- ✅ **Instanciación automática por slug** → Sin if/else
- ✅ **Errores claros si programa no existe** → Debug fácil
- ✅ **Extensible** → Agregar nuevos programas en minutos
- ✅ **TypeSafe** → La Factory valida que extienda la clase base

## 📁 Archivos Creados

```
app/Programs/
├── Abstracts/
│   └── AppProgramCreate.php                    # ← Clase base
├── Factory/
│   └── ProgramFactory.php                      # ← Factory
├── Implementations/
│   ├── BancolombiaProgram.php                  # ← Ejemplo 1
│   ├── BancoPopularProgram.php                 # ← Ejemplo 2
│   └── DemoProgram.php                         # ← Ejemplo 3 completo
├── DOCUMENTATION.md                            # ← Documentación completa
└── README.md                                   # ← Este archivo

tests/Feature/Programs/
└── ProgramFactoryTest.php                      # ← Tests unitarios
```

## ⚡ Uso Rápido

### En tu Controller

```php
use App\Programs\Factory\ProgramFactory;

// El Factory hace todo automáticamente:
// 1. Lee el slug del programa (ej: "banco-popular")
// 2. Lo convierte a nombre de clase (ej: "BancoPopularProgram")
// 3. Verifica que la clase existe
// 4. Instancia la clase
// 5. Ejecuta la instalación

$programInstaller = ProgramFactory::create($server, $program, $operationId);
$responseData = $programInstaller->getResponseData();
```

### Crear un nuevo programa (3 minutos)

**Archivo:** `app/Programs/Implementations/MiProgramaProgram.php`

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
        
        $this->setResponseData([
            'program' => 'MiPrograma',
            'status' => 'installed',
        ]);
    }
}
```

**Eso es.** Automáticamente el slug `mi-programa` instanciará esta clase.

## 🔄 Ciclo de Vida

Cada programa sigue este flujo:

```
1. isCompatibleWithServer()    ← Validar sistema
2. beforeInstall()             ← Preparar (descargas, etc)
3. install()                   ← Instalación principal
4. afterInstall()              ← Post-setup (servicios, etc)
5. completeOperation()         ← Marcar como completado
```

Cada paso puede hacer override en la subclase.

## 📋 Métodos Principales

### En `AppProgramCreate`

```php
// Registrar progreso
$this->logProgress("Mensaje aquí", ['extra' => 'data']);

// Ejecutar comando SSH
$result = $this->executeServerCommand("comando");

// Configurar respuesta
$this->setResponseData(['key' => 'value']);

// Obtener respuesta
$data = $this->getResponseData();
```

### Acceso a Propiedades

```php
$this->server;      // El servidor actual (Server model)
$this->program;     // El programa a instalar (ServerAvailablePrograms model)
$this->operationId; // ID único de la operación
```

## 🧪 Ejemplos

### Ejemplo Mínimo

```php
class SimpleProgram extends AppProgramCreate
{
    protected function install(): void
    {
        $this->logProgress("Instalando...");
        $this->executeServerCommand("apt-get install simple-program");
        $this->setResponseData(['status' => 'done']);
    }
}
```

### Ejemplo con Validación

```php
class ValidatedProgram extends AppProgramCreate
{
    protected function isCompatibleWithServer(): bool
    {
        if ($this->server->operatingSystem->slug !== 'linux') {
            throw new \Exception("Solo Linux");
        }
        if ($this->server->ram < 4) {
            throw new \Exception("Requiere 4GB RAM");
        }
        return true;
    }

    protected function install(): void
    {
        // ...
    }
}
```

### Ejemplo Completo (ver `DemoProgram.php`)

```php
class FullProgram extends AppProgramCreate
{
    protected function isCompatibleWithServer(): bool { /* ... */ }
    
    protected function beforeInstall(): void
    {
        parent::beforeInstall();
        $this->logProgress("Preparando...");
        // 5+ pasos
    }

    protected function install(): void
    {
        // 10+ pasos granulares
        $this->stepDownload();
        $this->stepVerify();
        $this->stepInstall();
        // ...
    }

    protected function afterInstall(): void
    {
        parent::afterInstall();
        // Iniciar servicios, health checks, etc
    }
}
```

## 🚨 Manejo de Errores

### Si el programa no existe

```
Exception: Programa no soportado: No existe la clase 'ProgramaNoExistenteProgram' 
           para el programa 'programa-no-existente'
```

Causa: Creaste el modelo en BD pero no la clase en `app/Programs/Implementations/`

### Si la clase no extiende `AppProgramCreate`

```
Exception: La clase 'MiClaseProgram' debe extender App\Programs\Abstracts\AppProgramCreate
```

Causa: Olvidaste poner `extends AppProgramCreate`

## 🧪 Testing

```bash
# Ejecutar tests del Factory
php artisan test tests/Feature/Programs/ProgramFactoryTest.php

# Tests incluyen:
# ✓ Instanciación correcta
# ✓ Conversión de slugs
# ✓ Validación de compatibilidad
# ✓ Excepciones apropiadas
```

## 📊 Conversión de Slugs

La Factory convierte automáticamente:

| Slug | Clase | Archivo |
|------|-------|---------|
| `bancolombia` | `BancolombiaProgram` | `BancolombiaProgram.php` |
| `banco-popular` | `BancoPopularProgram` | `BancoPopularProgram.php` |
| `demo` | `DemoProgram` | `DemoProgram.php` |
| `mi-programa` | `MiProgramaProgram` | `MiProgramaProgram.php` |
| `mi_programa` | `MiProgramaProgram` | `MiProgramaProgram.php` |
| `programa-super-largo` | `ProgramaSuperLargoProgram` | `ProgramaSuperLargoProgram.php` |

## 🔧 Troubleshooting

### "Clase no encontrada"

```
Solución: Verifica que el slug en BD coincida con el nombre de la clase
Slug: "banco-popular" → Clase: "BancoPopularProgram"
```

### "Error ejecutando comando SSH"

```
Verifica en AppProgramCreate::executeServerCommand()
que estés usando correctamente ConnectionsTrait
```

### Program se queda en "pending"

```
Revisa logs en storage/logs/
El error se captura en ServerActivityLog con status='failed'
```

## 📚 Documentación Completa

Ver [DOCUMENTATION.md](DOCUMENTATION.md) para:

- Métodos disponibles detallados
- Ciclo de vida completo
- Advanced features y ejemplos
- Architecture patterns

## 🎓 Resumen para Recordar

| Concepto | Ubicación | Acción |
|----------|-----------|--------|
| Crear nuevo programa | `app/Programs/Implementations/MiProgramaProgram.php` | Extender `AppProgramCreate` |
| Usar en controller | `ProgramFactory::create($server, $program, $operationId)` | Llamar factory |
| Hooks disponibles | `AppProgramCreate` | Override los que necesites |
| Si falla el programa | `ServerActivityLog` | Status='failed', ver error_message |
| Tests | `tests/Feature/Programs/` | `php artisan test` |

---

**Creado:** 2026-01-22 | **Versión:** 1.0 | **Autor:** Sistema Automático
