# ❓ Preguntas Frecuentes (FAQ)

## 🎯 Conceptos Generales

### P: ¿Por qué usar este sistema en lugar de un simple if/else?

**R:** 
- ✅ Con **Factory**: Agregar nuevo programa = crear 1 archivo
- ❌ Con **if/else**: Agregar nuevo programa = modificar código existente
- Diferencia: **Abierto para extensión, cerrado para modificación** (Principio SOLID)

### P: ¿Debo extender AppProgramCreate?

**R:** Sí, es obligatorio. Así garantizamos que todas las instalaciones:
- Tengan validación de compatibilidad
- Registren progreso en tiempo real
- Manejen errores consistentemente
- Devuelvan respuestas estructuradas

### P: ¿Puedo cambiar el ciclo de vida?

**R:** Sí, hay dos formas:

1. **Override hooks individuales** (recomendado)
```php
protected function beforeInstall(): void { }
protected function install(): void { }
protected function afterInstall(): void { }
```

2. **Override execute() completo** (avanzado)
```php
protected function execute(): void {
    $this->miLogicaPersonalizada();
    $this->completeOperation();
}
```

## 📁 Estructura de Archivos

### P: ¿Dónde creo la clase del programa?

**R:** Siempre en `app/Programs/Implementations/{Nombre}Program.php`

El Factory busca ahí automáticamente.

### P: ¿Por qué el sufijo "Program"?

**R:** Es convención para:
- Claridad: Sé que `BancolombiaProgram` es un programa
- Evitar conflictos: Si existiera clase `Bancolombia` en otro namespace
- Factory lo agrega automáticamente

### P: ¿Puedo cambiar esto?

**R:** Sí, pero:
1. Modifica `ProgramFactory::slugToClassName()`
2. Actualiza todos los tests
3. Documenta el cambio

No lo recomiendo, mejor mantén la convención.

## 🔄 Ciclo de Vida

### P: ¿Cuándo se ejecuta cada método?

**R:**
```
constructor
    ↓
execute()
    ├─ validateProgram()
    │   └─ isCompatibleWithServer() ← TÚ implementas
    ├─ beforeInstall() ← TÚ puedes override
    ├─ install() ← TÚ DEBES implementar
    ├─ afterInstall() ← TÚ puedes override
    └─ completeOperation()
```

### P: ¿Qué pasa si lanza excepción?

**R:** Se captura automáticamente:
1. Se llama `handleError()`
2. Se actualiza `ServerActivityLog` con status='failed'
3. Se broadcast error event
4. Se lanza la excepción al controller
5. Controller devuelve error response

### P: ¿Puedo tener pasos intermedios?

**R:** Sí, crea métodos privados:

```php
protected function install(): void
{
    $this->paso1_descargar();
    $this->paso2_validar();
    $this->paso3_instalar();
}

private function paso1_descargar(): void
{
    $this->logProgress("Descargando...");
    // ...
}
```

### P: ¿Debo llamar a `parent::beforeInstall()`?

**R:** Sí, si quieres mantener funcionalidad base:

```php
protected function beforeInstall(): void
{
    parent::beforeInstall();  // ← Ejecuta la lógica base
    
    // Tu lógica adicional
    $this->miPaso();
}
```

## 🔌 Integración

### P: ¿Cómo conecto con SSH?

**R:** Usa el método auxiliar:

```php
protected function install(): void
{
    $result = $this->executeServerCommand("apt-get install programa");
    
    if (!$result['success']) {
        throw new \Exception("SSH Error: " . $result['error']);
    }
}
```

Actualmente retorna mock. Integra con tu `ConnectionsTrait`.

### P: ¿Qué es executeServerCommand?

**R:** Método que:
1. Conecta por SSH al servidor
2. Ejecuta comando
3. Devuelve resultado
4. Registra progreso

```php
[
    'success' => true,
    'output' => 'output del comando',
    'error' => null
]
```

### P: ¿Cómo accedo al servidor?

**R:**
```php
$this->server;              // El servidor (Server model)
$this->server->ip;          // IP del servidor
$this->server->username;    // Usuario SSH
$this->server->ram;         // RAM disponible
$this->server->storage;     // Storage disponible
```

### P: ¿Cómo accedo al programa?

**R:**
```php
$this->program;             // El programa (ServerAvailablePrograms model)
$this->program->name;       // "Bancolombia"
$this->program->slug;       // "bancolombia"
$this->program->description; // Descripción
```

## 📊 Respuestas y Datos

### P: ¿Cómo envío datos de respuesta?

**R:**
```php
protected function install(): void
{
    // ...
    
    $this->setResponseData([
        'program' => 'MiPrograma',
        'version' => '1.0.0',
        'path' => '/opt/programa',
        'status' => 'installed'
    ]);
}
```

### P: ¿Qué datos debo retornar?

**R:** Los que el cliente necesite. Ejemplos:
```php
// Mínimo
['status' => 'installed']

// Normal
[
    'program' => 'MiPrograma',
    'path' => '/opt/programa',
    'version' => '1.0.0',
    'status' => 'installed'
]

// Completo
[
    'program' => 'MiPrograma',
    'path' => '/opt/programa',
    'version' => '1.0.0',
    'status' => 'installed',
    'service_name' => 'mi-programa',
    'port' => 9000,
    'database' => 'mi_db',
    'installed_at' => '2026-01-22 10:30:00',
    'next_steps' => ['Step 1', 'Step 2']
]
```

### P: ¿Puedo agregar datos progresivamente?

**R:** Sí:
```php
protected function beforeInstall(): void
{
    $this->setResponseData(['phase' => 'preparation']);
}

protected function install(): void
{
    $this->setResponseData(['phase' => 'installation', 'progress' => 50]);
    // ...
    $this->setResponseData(['phase' => 'installation', 'progress' => 100]);
}
```

## 🚨 Errores y Validación

### P: ¿Cómo valido compatibilidad?

**R:** Override `isCompatibleWithServer()`:

```php
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
```

### P: ¿Qué pasa si lanzo excepción?

**R:** Se maneja automáticamente:
```
Exception
    ↓
handleError()
    ├─ Log error
    ├─ Actualizar BD (status='failed')
    ├─ Broadcast error
    └─ Lanzar excepción al controller
```

### P: ¿Puedo capturar excepciones en la clase?

**R:** No es necesario, pero puedes si quieres lógica especial:

```php
protected function install(): void
{
    try {
        $this->executeServerCommand("comando");
    } catch (\Throwable $th) {
        $this->logProgress("Error específico: " . $th->getMessage());
        throw new \Exception("Instalación falló");
    }
}
```

### P: ¿Cómo logueo información?

**R:** Usa `logProgress()`:

```php
$this->logProgress("Mensaje simple");

$this->logProgress("Mensaje con detalles", [
    'server_id' => $this->server->id,
    'ram' => $this->server->ram,
    'timestamp' => now()
]);
```

Esto:
- Registra en `storage/logs/laravel.log`
- Broadcast evento en tiempo real
- Muestra progreso al cliente

## 🧪 Testing

### P: ¿Cómo tesтeo mi programa?

**R:** Agrega test en `tests/Feature/Programs/ProgramFactoryTest.php`:

```php
/** @test */
public function mi_programa_se_instancia_correctamente()
{
    $program = ServerAvailablePrograms::create([
        'name' => 'MiPrograma',
        'slug' => 'mi-programa',
        'description' => 'Test',
    ]);

    $installer = ProgramFactory::create(
        $this->server,
        $program,
        'op_test'
    );

    $this->assertInstanceOf(AppProgramCreate::class, $installer);
}
```

### P: ¿Cómo tesтeo validación?

**R:**
```php
/** @test */
public function mi_programa_valida_os()
{
    // Crear servidor con SO no compatible
    $server = Server::create([/* Windows */]);
    
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Linux');

    ProgramFactory::create($server, $program, 'op_test');
}
```

### P: ¿Cómo ejecuto los tests?

**R:**
```bash
# Todos
php artisan test tests/Feature/Programs/

# Específico
php artisan test tests/Feature/Programs/ProgramFactoryTest.php

# Verbose
php artisan test tests/Feature/Programs/ -v

# With output
php artisan test tests/Feature/Programs/ --debug
```

## 🔍 Troubleshooting

### P: "Clase no encontrada"

**R:** Verifica:
```bash
# 1. Archivo existe
ls app/Programs/Implementations/MiProgramaProgram.php

# 2. Namespace correcto
head -5 app/Programs/Implementations/MiProgramaProgram.php

# 3. Clase extiende correctamente
grep "class.*extends" app/Programs/Implementations/MiProgramaProgram.php
```

### P: "Error ejecutando comando SSH"

**R:** Verifica:
```bash
# 1. SSH key existe
ls ~/.ssh/id_rsa

# 2. SSH acceso al servidor
ssh -i ~/.ssh/id_rsa usuario@servidor

# 3. Logs de error
tail -f storage/logs/laravel.log

# 4. Comando es válido
ssh usuario@servidor "comando aqui"
```

### P: "Status sigue en pending"

**R:**
```bash
# 1. Ver qué pasó
SELECT * FROM server_activity_logs 
WHERE operation_id = 'op_xxx';

# 2. Ver error
SELECT error_message FROM server_activity_logs 
WHERE operation_id = 'op_xxx' AND status = 'failed';

# 3. Ver logs app
tail -f storage/logs/laravel.log | grep "Error"
```

### P: "Broadcasting no funciona"

**R:** Verifica:
```bash
# 1. Config broadcasting
cat config/broadcasting.php

# 2. Eventos existen
ls app/Events/ServerAction*.php

# 3. Reverb (si usas)
ps aux | grep reverb

# 4. Websocket conectado
# En browser console: Echo, Echo.channel
```

## 💡 Mejores Prácticas

### P: ¿Cuál es el orden recomendado?

**R:**
```php
protected function install(): void
{
    // 1. Validar
    $this->validatePreconditions();
    
    // 2. Preparar (descargar, crear dirs)
    $this->preparationSteps();
    
    // 3. Instalar (main logic)
    $this->installationSteps();
    
    // 4. Configurar
    $this->configurationSteps();
    
    // 5. Validar resultado (health check)
    $this->validateInstallation();
    
    // 6. Guardar metadata
    $this->setResponseData([...]);
}
```

### P: ¿Qué hacer en beforeInstall()?

**R:**
```php
protected function beforeInstall(): void
{
    parent::beforeInstall();
    
    // Descargar dependencias
    // Crear usuarios del sistema
    // Crear directorios
    // Actualizar repositorios
    // Instalar paquetes base
}
```

### P: ¿Qué hacer en afterInstall()?

**R:**
```php
protected function afterInstall(): void
{
    parent::afterInstall();
    
    // Iniciar servicios
    // Configurar firewall
    // Hacer health checks
    // Crear backups
    // Notificar
}
```

---

**FAQ Actualizado:** 2026-01-22 | **Versión:** 1.0
