# ⚡ Quick Start — Finanzas App Backend

## Entorno de desarrollo

### Requisitos

- PHP 8.3+
- Composer 2+
- MySQL 8+
- Node.js (para assets, opcional)

### Instalación completa

```bash
# 1. Instalar dependencias PHP
composer install

# 2. Configurar entorno
cp .env.example .env
php artisan key:generate

# 3. Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finanzas
DB_USERNAME=root
DB_PASSWORD=tu_password

# 4. Migrar base de datos
php artisan migrate

# 5. Poblar datos iniciales
php artisan db:seed

# 6. Iniciar servidor de desarrollo
php artisan serve
```

La API estará disponible en `http://localhost:8000/api`

---

## Servicios opcionales

### Queue Worker (para Jobs asíncronos)

```bash
# Desarrollo (manual)
php artisan queue:work

# Con más detalles
php artisan queue:work --verbose --tries=3
```

### WebSockets con Laravel Reverb

```bash
# Iniciar servidor WebSocket
php artisan reverb:start

# Con debug
php artisan reverb:start --debug
```

---

## Testing

```bash
# Todos los tests
php artisan test

# Tests de un archivo específico
php artisan test tests/Feature/UserTest.php

# Con cobertura
php artisan test --coverage
```

---

## Endpoints de prueba rápida

### 1. Login

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@finanzas.com","password":"password"}'
```

### 2. Usar el token

```bash
curl -X GET http://localhost:8000/api/me \
  -H "Authorization: Bearer TU_TOKEN_AQUI"
```

### 3. Listar usuarios

```bash
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer TU_TOKEN_AQUI"
```

---

## Comandos útiles de desarrollo

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Ver rutas disponibles
php artisan route:list --path=api

# Crear migration
php artisan make:migration create_transactions_table

# Crear model + migration + factory + seeder
php artisan make:model Transaction -mfs

# Crear Form Request
php artisan make:request StoreTransactionRequest

# Crear Policy
php artisan make:policy TransactionPolicy --model=Transaction

# Crear Observer
php artisan make:observer TransactionObserver --model=Transaction

# Crear Event
php artisan make:event ExpenseCreated

# Crear Listener
php artisan make:listener CheckBudgetExceeded --event=ExpenseCreated

# Crear Job
php artisan make:job GenerateFinancialReport
```

---

## Variables de entorno importantes

```env
APP_NAME="Finanzas App"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_DATABASE=finanzas

# Para WebSockets (Reverb)
BROADCAST_CONNECTION=reverb
REVERB_HOST=localhost
REVERB_PORT=6001

# Para colas
QUEUE_CONNECTION=database
```
