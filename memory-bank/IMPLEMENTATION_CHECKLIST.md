# ✅ Checklist de Implementación

## 📋 Instalación Base del Sistema

- [x] **Clase Base Abstracta**
  - [x] `/app/Programs/Abstracts/AppProgramCreate.php`
  - [x] Métodos de ciclo de vida
  - [x] Broadcasting de eventos
  - [x] Logging y progreso

- [x] **Factory Pattern**
  - [x] `/app/Programs/Factory/ProgramFactory.php`
  - [x] Conversión slug → className
  - [x] Validación de clase existente
  - [x] Validación de extensión correcta

- [x] **Ejemplos de Implementación**
  - [x] `/app/Programs/Implementations/BancolombiaProgram.php`
  - [x] `/app/Programs/Implementations/BancoPopularProgram.php`
  - [x] `/app/Programs/Implementations/DemoProgram.php`

- [x] **Controlador Actualizado**
  - [x] Importar `ProgramFactory`
  - [x] Método `addProgram()` refactorizado
  - [x] Manejo de errores mejorado

- [x] **Testing**
  - [x] `/tests/Feature/Programs/ProgramFactoryTest.php`
  - [x] Tests de Factory
  - [x] Tests de Implementaciones

- [x] **Documentación**
  - [x] `/app/Programs/README.md` - Quick Start
  - [x] `/app/Programs/DOCUMENTATION.md` - Documentación Completa
  - [x] `/app/Programs/ARCHITECTURE.md` - Diagramas

## 🔧 Pasos Siguientes (TODO)

### 1. Integración SSH en AppProgramCreate

- [ ] Implementar método `executeServerCommand()` completo
  - Actualmente retorna mock
  - Conectar con `ConnectionsTrait`
  - Usar SSH2 de `phpseclib3`

**Ubicación:** `app/Programs/Abstracts/AppProgramCreate.php` (línea ~170)

```php
protected function executeServerCommand(string $command): array
{
    try {
        // Usar ConnectionsTrait para obtener conexión SSH
        $ssh = $this->getSSHConnection();
        $output = $ssh->exec($command);
        
        return [
            'success' => true,
            'output' => $output,
        ];
    } catch (\Throwable $th) {
        throw new \Exception("SSH Error: {$th->getMessage()}");
    }
}
```

### 2. Migrations Base (Optional)

- [ ] Si no existen, crear migrations para:
  - `ServerActivityLog` si no existe
  - Asegurar columnas: `response_data`, `error_message`, `completed_at`

**Comando:**
```bash
php artisan make:migration create_server_activity_logs_table
```

### 3. Verificar Modelos

- [ ] `Server` model existe y tiene relaciones
- [ ] `ServerAvailablePrograms` model existe
- [ ] `ServerActivityLog` model existe
- [ ] Relaciones configuradas

### 4. Verificar Broadcasting

- [ ] Eventos `ServerActionProgress` existe
- [ ] Eventos `ServerActionComplete` existe
- [ ] Eventos `ServerActionError` existe
- [ ] Broadcasting configurado en `config/broadcasting.php`

**Verificar:**
```bash
ls app/Events/ServerAction*.php
```

### 5. Pruebas

- [ ] Ejecutar tests unitarios
  ```bash
  php artisan test tests/Feature/Programs/ProgramFactoryTest.php
  ```

- [ ] Test manual con Postman/Insomnia
  ```
  POST /api/server/1/add-program
  {
    "programId": 1,
    "operationId": "op_manual_test_1"
  }
  ```

- [ ] Verificar logs en `storage/logs/laravel.log`
- [ ] Verificar broadcasts en WebSocket

### 6. Crear Nuevos Programas

- [ ] Para cada nuevo programa:
  1. Crear clase en `app/Programs/Implementations/`
  2. Extender `AppProgramCreate`
  3. Implementar `install()` requerido
  4. Override hooks según necesario
  5. Agregar tests en `tests/Feature/Programs/`

### 7. Documentación del Proyecto

- [ ] Agregar a `memory-bank/` si existe documentación central
- [ ] Documenta tu estructura SSH/conexión
- [ ] Documenta los requisitos específicos de cada programa

## 🐛 Debugging

### Problema: "Clase no encontrada"

```bash
# Verificar que el archivo existe
ls app/Programs/Implementations/MiProgramaProgram.php

# Verificar namespace
grep "namespace" app/Programs/Implementations/MiProgramaProgram.php

# Verificar que extiende correctamente
grep "extends AppProgramCreate" app/Programs/Implementations/MiProgramaProgram.php
```

### Problema: "Error ejecutando comando"

```bash
# Revisar logs
tail -f storage/logs/laravel.log

# Verificar SSH key existe
ls ~/.ssh/id_rsa
```

### Problema: "Operación en pending"

```bash
# Revisar BD
SELECT * FROM server_activity_logs WHERE operation_id = 'op_xxx';

# Ver error_message
SELECT error_message FROM server_activity_logs WHERE status = 'failed';
```

## 📊 Checklist de Cada Nuevo Programa

Cuando crees un nuevo programa, verifica:

- [ ] Archivo creado: `app/Programs/Implementations/{Nombre}Program.php`
- [ ] Namespace correcto: `namespace App\Programs\Implementations;`
- [ ] Extiende `AppProgramCreate`
- [ ] Método `install()` implementado
- [ ] Validaciones en `isCompatibleWithServer()` si needed
- [ ] Pasos en `beforeInstall()` si needed
- [ ] Limpieza en `afterInstall()` si needed
- [ ] `setResponseData()` con datos útiles
- [ ] Tests creados en `tests/Feature/Programs/`
- [ ] Test que la clase se instancia
- [ ] Test que valida compatible
- [ ] Test que valida no compatible

## 🚀 Deployment

- [ ] Código en git
- [ ] Tests pasando: `php artisan test`
- [ ] No hay errores de linting: `php artisan tinker`
- [ ] Modelos y migrations en BD
- [ ] Broadcasting configurado
- [ ] SSH configurado en servidores
- [ ] Permisos SSH correctos
- [ ] Logs configurados

## 📝 Próximas Mejoras

- [ ] Admin panel para agregar programas dinámicamente (sin código)
- [ ] UI para monitorear instalación en tiempo real
- [ ] Rollback automático si instalación falla
- [ ] Scheduling de instalaciones
- [ ] Estadísticas de instalaciones
- [ ] Alertas si programa falla repetidamente

---

**Actualizado:** 2026-01-22 | **Versión:** 1.0
