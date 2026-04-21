<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use App\Traits\ApiResponse;

class MenuController extends Controller
{
    use ApiResponse;

    /**
     * Menú jerárquico
     *
     * Retorna todos los menús en estructura jerárquica (padre-hijo) visibles.
     * Útil para construir la navegación de la aplicación.
     *
     * @group Menú
     *
     * @response 200 scenario="Menú jerárquico" {
     *   "success": true,
     *   "message": "Menú jerárquico obtenido exitosamente",
     *   "data": [
     *     {
     *       "id": 1,
     *       "key": "dashboard",
     *       "label": "Dashboard",
     *       "icon": "bx-home",
     *       "link": "/dashboard",
     *       "is_title": false,
     *       "order": 1,
     *       "flag_visible": true,
     *       "children": []
     *     },
     *     {
     *       "id": 2,
     *       "key": "admin",
     *       "label": "Administración",
     *       "icon": "bx-cog",
     *       "link": null,
     *       "is_title": true,
     *       "order": 2,
     *       "flag_visible": true,
     *       "children": [
     *         {
     *           "id": 3,
     *           "key": "usuarios",
     *           "label": "Usuarios",
     *           "icon": "bx-user",
     *           "link": "/admin/usuarios",
     *           "is_title": false,
     *           "order": 1,
     *           "flag_visible": true,
     *           "children": []
     *         }
     *       ]
     *     }
     *   ]
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function hierarchical()
    {
        try {
            $menus = Menu::rootMenus()->get();

            $hierarchicalMenus = $menus->map(fn($menu) => $menu->toHierarchical())->toArray();

            return $this->successResponse(
                $hierarchicalMenus,
                __('messages.menu.hierarchical_success'),
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                __('messages.general.error_retry'),
                [],
                500
            );
        }
    }

    /**
     * Listar menús
     *
     * Retorna todos los menús visibles paginados, ordenados por el campo `order`.
     * Incluye items de todos los niveles jerárquicos en lista plana.
     *
     * @group Menú
     *
     * @response 200 scenario="Lista de menús" {
     *   "success": true,
     *   "message": "Menús obtenidos exitosamente",
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 1,
     *         "key": "dashboard",
     *         "label": "Dashboard",
     *         "icon": "bx-home",
     *         "link": "/dashboard",
     *         "parent_key": null,
     *         "is_title": false,
     *         "collapsed": false,
     *         "order": 1,
     *         "flag_visible": true,
     *         "id_sistema": 1
     *       }
     *     ],
     *     "per_page": 15,
     *     "total": 20
     *   }
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function index()
    {
        try {
            $menus = Menu::visible()
                ->orderBy('order', 'asc')
                ->paginate(15);

            return $this->successResponse($menus, __('messages.menu.list_success'), 200);
        } catch (\Exception $e) {
            return $this->errorResponse(
                __('messages.general.error_retry'),
                [],
                500
            );
        }
    }

    /**
     * Crear menú
     *
     * Crea un nuevo ítem de menú. Si se especifica `parent_key`, el menú
     * se anida como hijo del padre indicado.
     *
     * @group Menú
     *
     * @bodyParam key string required Identificador único del menú. Example: reportes
     * @bodyParam label string required Etiqueta visible del menú. Example: Reportes
     * @bodyParam icon string Ícono del menú (clase CSS). Example: bx-bar-chart
     * @bodyParam link string URL o ruta del menú. Example: /reportes
     * @bodyParam parent_key string Clave del menú padre (para anidamiento). Example: admin
     * @bodyParam is_title boolean Indica si es un título de sección. Example: false
     * @bodyParam collapsed boolean Indica si el menú comienza colapsado. Example: true
     * @bodyParam id_sistema_pantalla integer ID de la pantalla del sistema. Example: 5
     * @bodyParam order integer Orden de aparición. Example: 3
     * @bodyParam padre_id integer ID del padre en sistema legado. Example: 0
     * @bodyParam icon_id integer ID del ícono en catálogo. Example: 12
     * @bodyParam flag_detalle boolean Indica si tiene vista de detalle. Example: false
     * @bodyParam flag_visible boolean Indica si el menú es visible. Por defecto: true. Example: true
     * @bodyParam id_sistema integer ID del sistema al que pertenece. Example: 1
     * @bodyParam bt_login string Usuario que crea el registro. Example: admin
     *
     * @response 201 scenario="Menú creado" {
     *   "success": true,
     *   "message": "Menú creado exitosamente",
     *   "data": {
     *     "id": 10,
     *     "key": "reportes",
     *     "label": "Reportes",
     *     "icon": "bx-bar-chart",
     *     "link": "/reportes",
     *     "is_title": false,
     *     "collapsed": true,
     *     "order": 3,
     *     "flag_visible": true,
     *     "children": []
     *   }
     * }
     * @response 404 scenario="Padre no encontrado" {
     *   "success": false,
     *   "message": "El menú padre no fue encontrado",
     *   "errors": []
     * }
     * @response 422 scenario="Validación fallida" {
     *   "success": false,
     *   "message": "Los datos proporcionados no son válidos",
     *   "errors": { "key": ["El campo key ya existe."] }
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(StoreMenuRequest $request)
    {
        try {
            // Obtener el parent_menu_id basado en parent_key
            $parentMenuId = null;
            if ($request->parent_key) {
                $parentMenu = Menu::where('key', $request->parent_key)->first();
                $parentMenuId = $parentMenu?->id;

                if (!$parentMenuId) {
                    return $this->errorResponse(__('messages.menu.parent_not_found'), [], 404);
                }
            }

            $menu = Menu::create([
                'key' => $request->key,
                'label' => $request->label,
                'icon' => $request->icon,
                'link' => $request->link,
                'parent_key' => $request->parent_key,
                'is_title' => $request->is_title ?? false,
                'collapsed' => $request->collapsed ?? true,
                'id_sistema_pantalla' => $request->id_sistema_pantalla,
                'order' => $request->order ?? 0,
                'padre_id' => $request->padre_id ?? 0,
                'icon_id' => $request->icon_id,
                'flag_detalle' => $request->flag_detalle ?? false,
                'flag_visible' => $request->flag_visible ?? true,
                'id_sistema' => $request->id_sistema,
                'parent_menu_id' => $parentMenuId,
                'bt_login' => $request->bt_login,
                'bt_fecha' => now(),
            ]);

            return $this->successResponse(
                $menu->toHierarchical(),
                __('messages.menu.created'),
                201
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                __('messages.general.error_retry'),
                [],
                500
            );
        }
    }

    /**
     * Obtener menú
     *
     * Retorna los datos de un menú específico en estructura jerárquica,
     * incluyendo sus submenús anidados.
     *
     * @group Menú
     *
     * @urlParam menu integer required ID del menú. Example: 1
     *
     * @response 200 scenario="Menú encontrado" {
     *   "success": true,
     *   "message": "Menú obtenido exitosamente",
     *   "data": {
     *     "id": 1,
     *     "key": "admin",
     *     "label": "Administración",
     *     "icon": "bx-cog",
     *     "link": null,
     *     "is_title": true,
     *     "collapsed": false,
     *     "order": 2,
     *     "flag_visible": true,
     *     "children": [
     *       { "id": 3, "key": "usuarios", "label": "Usuarios", "children": [] }
     *     ]
     *   }
     * }
     * @response 404 scenario="Menú no encontrado" {
     *   "message": "No query results for model [App\\Models\\Menu]."
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function show(Menu $menu)
    {
        try {
            return $this->successResponse(
                $menu->toHierarchical(),
                __('messages.menu.show_success'),
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                __('messages.general.error_retry'),
                [],
                500
            );
        }
    }

    /**
     * Actualizar menú
     *
     * Actualiza los datos de un menú existente. Si se cambia `parent_key`,
     * se actualiza el anidamiento jerárquico.
     *
     * @group Menú
     *
     * @urlParam menu integer required ID del menú a actualizar. Example: 1
     *
     * @bodyParam key string Identificador único del menú. Example: reportes-v2
     * @bodyParam label string Etiqueta visible del menú. Example: Reportes Avanzados
     * @bodyParam icon string Ícono del menú. Example: bx-bar-chart-alt
     * @bodyParam link string URL o ruta del menú. Example: /reportes/avanzados
     * @bodyParam parent_key string Clave del nuevo padre (para cambiar jerarquía). Example: admin
     * @bodyParam is_title boolean Indica si es título de sección. Example: false
     * @bodyParam collapsed boolean Indica si comienza colapsado. Example: false
     * @bodyParam order integer Orden de aparición. Example: 5
     * @bodyParam flag_visible boolean Visibilidad del menú. Example: true
     * @bodyParam id_sistema integer ID del sistema al que pertenece. Example: 1
     *
     * @response 200 scenario="Menú actualizado" {
     *   "success": true,
     *   "message": "Menú actualizado exitosamente",
     *   "data": {
     *     "id": 1,
     *     "key": "reportes-v2",
     *     "label": "Reportes Avanzados",
     *     "icon": "bx-bar-chart-alt",
     *     "link": "/reportes/avanzados",
     *     "order": 5,
     *     "flag_visible": true,
     *     "children": []
     *   }
     * }
     * @response 404 scenario="Padre no encontrado" {
     *   "success": false,
     *   "message": "El menú padre no fue encontrado",
     *   "errors": []
     * }
     * @response 422 scenario="Validación fallida" {
     *   "success": false,
     *   "message": "Los datos proporcionados no son válidos",
     *   "errors": { "key": ["El campo key ya existe."] }
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        try {
            // Obtener el parent_menu_id basado en parent_key
            $parentMenuId = $menu->parent_menu_id;
            if ($request->parent_key) {
                $parentMenu = Menu::where('key', $request->parent_key)
                    ->where('id', '!=', $menu->id)
                    ->first();

                if ($parentMenu) {
                    $parentMenuId = $parentMenu->id;
                } elseif ($request->parent_key !== $menu->parent_key) {
                    return $this->errorResponse(__('messages.menu.parent_not_found'), [], 404);
                }
            }

            $menu->update([
                'key' => $request->key,
                'label' => $request->label,
                'icon' => $request->icon,
                'link' => $request->link,
                'parent_key' => $request->parent_key,
                'is_title' => $request->is_title ?? $menu->is_title,
                'collapsed' => $request->collapsed ?? $menu->collapsed,
                'id_sistema_pantalla' => $request->id_sistema_pantalla,
                'order' => $request->order ?? $menu->order,
                'padre_id' => $request->padre_id ?? $menu->padre_id,
                'icon_id' => $request->icon_id,
                'flag_detalle' => $request->flag_detalle ?? $menu->flag_detalle,
                'flag_visible' => $request->flag_visible ?? $menu->flag_visible,
                'id_sistema' => $request->id_sistema,
                'parent_menu_id' => $parentMenuId,
                'bt_login' => $request->bt_login,
            ]);

            return $this->successResponse(
                $menu->fresh()->toHierarchical(),
                __('messages.menu.updated'),
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                __('messages.general.error_retry'),
                [],
                500
            );
        }
    }

    /**
     * Eliminar menú
     *
     * Elimina un menú del sistema. No se puede eliminar si tiene submenús asociados.
     * Primero elimine o reasigne los submenús hijos.
     *
     * @group Menú
     *
     * @urlParam menu integer required ID del menú a eliminar. Example: 10
     *
     * @response 200 scenario="Menú eliminado" {
     *   "success": true,
     *   "message": "Menú eliminado exitosamente",
     *   "data": null
     * }
     * @response 422 scenario="Tiene submenús" {
     *   "success": false,
     *   "message": "No se puede eliminar el menú porque tiene submenús asociados",
     *   "errors": []
     * }
     * @response 404 scenario="Menú no encontrado" {
     *   "message": "No query results for model [App\\Models\\Menu]."
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function destroy(Menu $menu)
    {
        try {
            // Si el menú tiene submenús, no permitir eliminación
            if ($menu->subMenus()->exists()) {
                return $this->errorResponse(
                    __('messages.menu.has_submenus'),
                    [],
                    422
                );
            }

            $menu->delete();

            return $this->successResponse(
                null,
                __('messages.menu.deleted'),
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                __('messages.general.error_retry'),
                [],
                500
            );
        }
    }

    /**
     * Menús por sistema
     *
     * Retorna todos los menús jerárquicos que pertenecen a un sistema específico.
     * Útil para construir la navegación de un módulo específico.
     *
     * @group Menú
     *
     * @urlParam idSistema integer required ID del sistema. Example: 1
     *
     * @response 200 scenario="Menús del sistema" {
     *   "success": true,
     *   "message": "Menús del sistema obtenidos exitosamente",
     *   "data": [
     *     {
     *       "id": 1,
     *       "key": "dashboard",
     *       "label": "Dashboard",
     *       "icon": "bx-home",
     *       "link": "/dashboard",
     *       "is_title": false,
     *       "order": 1,
     *       "id_sistema": 1,
     *       "children": []
     *     }
     *   ]
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function bySystem($idSistema)
    {
        try {
            $menus = Menu::where('id_sistema', $idSistema)
                ->rootMenus()
                ->get();

            $hierarchicalMenus = $menus->map(fn($menu) => $menu->toHierarchical())->toArray();

            return $this->successResponse(
                $hierarchicalMenus,
                __('messages.menu.by_system_success'),
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                __('messages.general.error_retry'),
                [],
                500
            );
        }
    }
}
