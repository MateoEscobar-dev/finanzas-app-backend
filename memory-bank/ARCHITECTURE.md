# 🏗️ Arquitectura del Sistema de Programas Dinámicos

## Diagrama de Flujo

```
┌─────────────────────────────────────────────────────────────────┐
│                    POST /api/server/{id}/add-program             │
└─────────────────────────────────────────────────────────────────┘
                                │
                                ▼
┌─────────────────────────────────────────────────────────────────┐
│            ServerController::addProgram()                        │
│                                                                   │
│  - Valida programId                                              │
│  - Obtiene Server y ServerAvailablePrograms                      │
│  - Crea registro en ServerActivityLog                            │
└─────────────────────────────────────────────────────────────────┘
                                │
                                ▼
┌─────────────────────────────────────────────────────────────────┐
│         ProgramFactory::create($server, $program, $opId)         │
│                                                                   │
│  1. Slug "banco-popular" → Clase "BancoPopularProgram"          │
│  2. Verifica que clase existe                                    │
│  3. Verifica que extiende AppProgramCreate                       │
│  4. Instancia la clase                                           │
└─────────────────────────────────────────────────────────────────┘
                                │
                                ▼
                    ┌───────────────────────┐
                    │   new XXXProgram()    │
                    │   Constructor llama   │
                    │     $this->execute()  │
                    └───────────────────────┘
                                │
        ┌───────────────────────┼───────────────────────┐
        │                       │                       │
        ▼                       ▼                       ▼
    ┌────────────┐          ┌────────────┐          ┌────────────┐
    │ Validation │          │ Installation      │ Post-Install │
    │            │          │                   │              │
    │ 1. is      │ ──────→  │ 2. before  ──→   │ 4. after   │
    │ Compatible │          │    install        │    install │
    │                        │                   │              │
    │ 3. install │ (override) │                   │ 5. complete │
    │ (required) │          │                   │    operation │
    └────────────┘          └────────────┘          └────────────┘
        │                       │                       │
        └───────────────────────┼───────────────────────┘
                                │
                                ▼
        ┌──────────────────────────────────────────────┐
        │          Broadcast Events en Tiempo Real     │
        │                                               │
        │  ServerActionProgress → (Cada logProgress)   │
        │  ServerActionComplete → (Al finalizar)       │
        │  ServerActionError   → (En caso de error)    │
        └──────────────────────────────────────────────┘
```

## Estructura de Clases

```
┌─────────────────────────────────────────────────────────────┐
│         AppProgramCreate (Clase Base Abstracta)             │
├─────────────────────────────────────────────────────────────┤
│ PROPIEDADES PROTEGIDAS                                      │
│ - $server: Server                                           │
│ - $program: ServerAvailablePrograms                         │
│ - $operationId: string                                      │
│ - $responseData: array                                      │
├─────────────────────────────────────────────────────────────┤
│ MÉTODOS A OVERRIDE (Opcionales)                            │
│ - execute(): void                                           │
│ - validateProgram(): void                                   │
│ - isCompatibleWithServer(): bool ← Validación personal     │
│ - beforeInstall(): void ← Pasos pre-instalación            │
│ - afterInstall(): void ← Pasos post-instalación            │
│ - completeOperation(): void                                 │
├─────────────────────────────────────────────────────────────┤
│ MÉTODOS ABSTRACTOS (Obligatorio)                           │
│ *** protected abstract function install(): void ***         │
├─────────────────────────────────────────────────────────────┤
│ MÉTODOS AUXILIARES PROTEGIDOS                              │
│ - logProgress(string, array): void                         │
│ - executeServerCommand(string): array                      │
│ - setResponseData(array): void                             │
│ - handleError(\Throwable): void                            │
└─────────────────────────────────────────────────────────────┘
    △                   △                   △
    │                   │                   │
    │                   │                   │
    │               extends             extends
    │                   │                   │
    │                   │                   │
┌─────────────────┐ ┌─────────────────┐ ┌─────────────────┐
│ Bancolombia     │ │ BancoPopular    │ │ DemoProgram     │
│Program          │ │Program          │ │                 │
├─────────────────┤ ├─────────────────┤ ├─────────────────┤
│ + isCompatible  │ │ + isCompatible  │ │ + isCompatible  │
│ + beforeInstall │ │ + beforeInstall │ │ + beforeInstall │
│ + install()     │ │ + install()     │ │ + install()     │
│ + afterInstall  │ │ + afterInstall  │ │ + afterInstall  │
│                 │ │                 │ │                 │
│ Lógica          │ │ Lógica          │ │ Lógica          │
│ específica      │ │ específica      │ │ específica      │
│ de Bancolombia  │ │ de BancoPopular │ │ de Demo         │
└─────────────────┘ └─────────────────┘ └─────────────────┘
```

## Factory Pattern

```
ProgramFactory
│
├─ Entrada: slug = "banco-popular"
│
├─ Transformar: "banco-popular" → "BancoPopularProgram"
│
├─ Validar:
│  ├─ ¿Existe la clase?
│  │  └─ App\Programs\Implementations\BancoPopularProgram
│  │
│  └─ ¿Extiende AppProgramCreate?
│     └─ new ReflectionClass() → isSubclassOf()
│
├─ Instanciar:
│  └─ new BancoPopularProgram($server, $program, $operationId)
│
└─ Salida: instancia de BancoPopularProgram
```

## Ciclo de Vida Completo

```
REQUEST
   │
   ▼
addProgram($request, $id)
   │
   ├─ Validar inputs
   ├─ Cargar Server y Program
   └─ Crear ServerActivityLog (status='pending')
   │
   ▼
ProgramFactory::create(...)
   │
   ├─ Convertir slug → className
   ├─ Verificar existencia de clase
   └─ Verificar que extienda AppProgramCreate
   │
   ▼
new BancoPopularProgram($server, $program, $operationId)
   │
   ├─ Ejecutar constructor
   └─ Llamar $this->execute()
   │
   ▼
execute() - Ciclo de Vida
   │
   ├─ validateProgram()
   │  └─ Llamar isCompatibleWithServer() ← Override si needed
   │
   ├─ beforeInstall() ← Override si needed
   │  └─ Pasos de preparación
   │
   ├─ install() ← OBLIGATORIO override
   │  └─ Lógica principal
   │
   ├─ afterInstall() ← Override si needed
   │  └─ Pasos posteriores
   │
   └─ completeOperation()
      ├─ Actualizar ServerActivityLog (status='completed')
      └─ Broadcast ServerActionComplete
   │
   ▼
getResponseData()
   │
   ▼
return successResponse($data)
   │
   ▼
RESPONSE (HTTP 200)
   │
   └─ {
        "success": true,
        "message": "Programa agregado correctamente",
        "data": { ... }
      }
```

## Manejo de Errores

```
┌─────────────────────────────────────┐
│    Algún paso lanza Exception       │
└─────────────────────────────────────┘
         │
         ▼
    ¿En qué fase?
    │
    ├─ isCompatibleWithServer() → No compatible
    ├─ beforeInstall() → Error en preparación
    ├─ install() → Error en instalación
    └─ afterInstall() → Error en post-setup
         │
         ▼
    handleError(\Throwable)
    │
    ├─ Log error en storage/logs
    ├─ Actualizar ServerActivityLog
    │  ├─ status = 'failed'
    │  ├─ error_message = mensaje
    │  └─ completed_at = now()
    │
    └─ broadcast(ServerActionError)
       │
       ▼
    Controller catch
    │
    └─ return errorResponse()
```

## Base de Datos

```sql
-- ServerActivityLog
┌──────────────────────────────────────────────────────┐
│ operation_id  │ server_id │ program_id │ status     │
│ "op_abc123"   │ 1         │ 5          │ "completed"│
│ "op_def456"   │ 2         │ 3          │ "failed"   │
│ "op_ghi789"   │ 1         │ 2          │ "pending"  │
├──────────────────────────────────────────────────────┤
│ response_data           │ error_message │ completed_at  │
│ JSON object             │ null          │ 2026-01-22... │
│ JSON object             │ "Error msg"   │ 2026-01-22... │
│ null                    │ null          │ null          │
└──────────────────────────────────────────────────────┘
```

## Broadcasting (WebSockets)

```
Durante la instalación:

broadcast(new ServerActionProgress($operationId, "Paso 1...", []))
broadcast(new ServerActionProgress($operationId, "Paso 2...", []))
broadcast(new ServerActionProgress($operationId, "Paso 3...", []))
broadcast(new ServerActionProgress($operationId, "Paso 4...", []))
...
broadcast(new ServerActionComplete($operationId, "Completado"))

O si error:

broadcast(new ServerActionError($operationId, "Mensaje de error", "CODE"))
```

Cliente escucha:
```javascript
Echo.channel(`server-action.${operationId}`)
    .listen('ServerActionProgress', (event) => {
        console.log(event.message); // "Paso 1..."
    })
    .listen('ServerActionComplete', (event) => {
        console.log("✓ Completado");
    })
    .listen('ServerActionError', (event) => {
        console.log("✗ Error: " + event.message);
    });
```

## Extensibilidad

```
Para agregar nuevo programa:

1. Crear archivo: app/Programs/Implementations/NuevoProgramaProgram.php
2. Clase: class NuevoProgramaProgram extends AppProgramCreate { }
3. Implementar: protected function install(): void { }
4. Agregar slug en BD con slug="nuevo-programa"

El Factory hace el resto automáticamente.
```

---

**Visualizado:** 2026-01-22 | **Versión:** 1.0
