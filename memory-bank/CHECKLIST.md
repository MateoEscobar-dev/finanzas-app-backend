# ✅ Checklist de Calidad — Finanzas App Backend

Usar este checklist antes de hacer PR o marcar una tarea como completada.

---

## 🏗️ Arquitectura

- [ ] La lógica de negocio está en un **Service**, no en el Controller
- [ ] Las queries están en un **Repository**, no en el Controller ni en el Service
- [ ] El Controller solo orquesta (instancia Service, llama método, retorna respuesta)
- [ ] Se usa **inyección de dependencias** (no `new Service()` dentro del Controller)
- [ ] Se creó una **Interface** para el Repository
- [ ] El binding Interface → Implementación está en un **ServiceProvider**

---

## 🔐 Autorización y Seguridad

- [ ] Las rutas privadas están dentro del grupo `auth:sanctum`
- [ ] Si el endpoint accede a un recurso ajeno (por ID), tiene **Policy** de ownership
- [ ] No hay lógica de autorización con `if ($user->id != $resource->user_id)` manual en Controllers — esto va en Policy
- [ ] No se exponen datos sensibles en la respuesta (contraseñas, tokens, etc.)
- [ ] Los campos encriptados están en el array `$encryptable` del modelo

---

## ✅ Validaciones

- [ ] Existe un **FormRequest** para StoreX y UpdateX
- [ ] No hay `$request->validate()` directo en el Controller
- [ ] Los mensajes de validación están en **español**
- [ ] Las reglas incluyen `exists:tabla,id` para FK
- [ ] Los campos opcionales tienen la regla `nullable`

---

## 📊 Modelos y BD

- [ ] Los filtros frecuentes están como **Scopes** en el modelo (no queries en el Repository)
- [ ] Las relaciones Eloquent están definidas en el modelo
- [ ] Se usa `$fillable` (no `$guarded = []`)
- [ ] Las migraciones tienen `rollback` funcional (método `down()`)
- [ ] Los campos nuevos sensibles están en `$encryptable` si aplica

---

## 🔔 Eventos y Observadores

- [ ] Las operaciones con efectos secundarios disparan un **evento** con `event()`
- [ ] Los efectos secundarios están en **Listeners** (no inline en el Service)
- [ ] El **Observer** del modelo está registrado en `AppServiceProvider::boot()`
- [ ] Los Listeners de alto volumen usan `ShouldQueue`

---

## 📮 Jobs y Colas

- [ ] Cualquier operación que tome más de 1 segundo es un **Job**
- [ ] El Job implementa `ShouldQueue`
- [ ] El Controller retorna **202** cuando despacha un Job
- [ ] El Job emite un evento `broadcast` al completarse (si hay frontend esperando)

---

## 🌐 Respuestas API

- [ ] Todas las respuestas usan el trait **ApiResponse**
- [ ] El código HTTP es correcto (200, 201, 202, 403, 404, 422, 500)
- [ ] Los errores internos se loguean con **LogTrait**
- [ ] El try/catch captura `\Throwable`, no solo `\Exception`
- [ ] La paginación usa `take`/`skip` con máximo 100 registros por página

---

## 📝 Logging y Auditoría

- [ ] Cada operación CRUD llama a `$this->createLog()`
- [ ] El tipo de log es correcto: `CREATE`, `UPDATE`, `DELETE`, `READ`
- [ ] Los errores pasan el `\Throwable $th` a `createLog()`

---

## 🧪 Pruebas

- [ ] Existe al menos 1 test de Feature para el endpoint
- [ ] El test cubre el caso feliz (200/201/202)
- [ ] El test cubre el caso de recurso no encontrado (404)
- [ ] El test cubre la validación (422)
- [ ] El test cubre el acceso no autorizado (401/403)

---

## 📦 General

- [ ] No hay código de depuración (`dd()`, `dump()`, `var_dump()`, `print_r()`)
- [ ] No hay `TODO` en el código enviado
- [ ] Los nombres son en **inglés** (clases, métodos, variables)
- [ ] Los comentarios/mensajes de usuario están en **español**
