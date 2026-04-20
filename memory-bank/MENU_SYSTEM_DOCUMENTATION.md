# Sistema de Menús — Documentación

> El sistema de menús es jerárquico (árbol padre-hijo auto-referencial). Cada menú puede tener submenús, y se expone de forma plana o jerárquica según el endpoint.

## Modelo: `Menu`

**Archivo:** `app/Models/Menu.php`

### Campos principales

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `key` | string | Identificador único del ítem de menú |
| `label` | string | Texto a mostrar (internacionalizable) |
| `icon` | string | Clase de ícono |
| `link` | string | URL o ruta del ítem |
| `parent_key` | string\|null | Key del menú padre |
| `parent_menu_id` | int\|null | FK al menú padre (auto-referencial) |
| `is_title` | boolean | Si es un encabezado de sección |
| `collapsed` | boolean | Si inicia colapsado |
| `order` | int | Orden de aparición |
| `flag_visible` | boolean | Si es visible en el menú |
| `flag_detalle` | boolean | Si tiene vista de detalle |
| `id_sistema` | int | Sistema al que pertenece |

### Relaciones

```php
// Un menú pertenece a un padre
public function parentMenu(): BelongsTo

// Un menú tiene muchos submenús (hijos directos), ordenados
public function subMenus(): HasMany
```

### Scopes

```php
// Solo menús raíz (sin padre), visibles, ordenados
Menu::rootMenus()->get();

// Solo menús visibles
Menu::visible()->get();
```

### Método `toHierarchical()`

Convierte el modelo a un array con toda la estructura anidada (hijos incluidos recursivamente).

```php
$menu->toHierarchical();
// Retorna: key, label, icon, link, subMenu: [...hijos recursivos]
```

---

## Endpoints

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/api/menu` | Listar todos los menús visibles paginados |
| POST | `/api/menu` | Crear un nuevo ítem de menú |
| GET | `/api/menu/{id}` | Obtener un ítem específico |
| PUT | `/api/menu/{id}` | Actualizar un ítem |
| DELETE | `/api/menu/{id}` | Eliminar un ítem |
| GET | `/api/menu/hierarchical` | Árbol completo (desde raíz con hijos) |
| GET | `/api/menu/by-system/{idSistema}` | Menús filtrados por sistema |

---

## Jerarquía

```
Menú Raíz (parent_menu_id = null)
├── Submenú 1 (parent_menu_id = raiz.id)
│   ├── Sub-submenú A
│   └── Sub-submenú B
└── Submenú 2
    └── Sub-submenú C
```

- `GET /api/menu/hierarchical` devuelve el árbol completo desde la raíz
- `GET /api/menu` devuelve todos los ítems planos con paginación

---

## Form Requests

**StoreMenuRequest** — Validaciones al crear:
- `key`: requerido, string, único en `menus`
- `label`: requerido, string
- `parent_key`: opcional, debe existir en `menus.key`
- `order`: opcional, entero

**UpdateMenuRequest** — Mismas reglas con `sometimes` (campos opcionales).

---

## Ejemplo de Respuesta Jerárquica

```json
[
  {
    "key": "dashboard",
    "label": "Dashboard",
    "icon": "mdi mdi-home",
    "link": "/dashboard",
    "isTitle": false,
    "collapsed": false,
    "order": 1,
    "flagVisible": true,
    "subMenu": []
  },
  {
    "key": "finanzas",
    "label": "Finanzas",
    "icon": "mdi mdi-cash",
    "link": null,
    "isTitle": true,
    "collapsed": true,
    "order": 2,
    "flagVisible": true,
    "subMenu": [
      {
        "key": "gastos",
        "label": "Gastos",
        "icon": "mdi mdi-arrow-down",
        "link": "/gastos",
        "subMenu": []
      },
      {
        "key": "ingresos",
        "label": "Ingresos",
        "icon": "mdi mdi-arrow-up",
        "link": "/ingresos",
        "subMenu": []
      }
    ]
  }
]
```

---

## Referencia

- `app/Models/Menu.php`
- `app/Http/Controllers/Api/MenuController.php`
- `app/Http/Requests/StoreMenuRequest.php`
- `app/Http/Requests/UpdateMenuRequest.php`
- [MENU_QUICK_REFERENCE.md](MENU_QUICK_REFERENCE.md)
- [MENU_INTEGRATION_EXAMPLES.md](MENU_INTEGRATION_EXAMPLES.md)
