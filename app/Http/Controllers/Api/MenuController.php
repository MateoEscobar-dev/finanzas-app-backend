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
     * Obtener menú jerárquico
     * GET /api/menu/hierarchical
     */
    public function hierarchical()
    {
        try {
            $menus = Menu::rootMenus()->get();

            $hierarchicalMenus = $menus->map(fn($menu) => $menu->toHierarchical())->toArray();

            return $this->successResponse(
                $hierarchicalMenus,
                'Menú jerárquico obtenido correctamente',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error al obtener el menú jerárquico: ' . $e->getMessage(),
                [],
                500
            );
        }
    }

    /**
     * Listar todos los menús
     * GET /api/menu
     */
    public function index()
    {
        try {
            $menus = Menu::visible()
                ->orderBy('order', 'asc')
                ->paginate(15);

            return $this->successResponse($menus, 'Menús obtenidos correctamente', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error al obtener los menús: ' . $e->getMessage(),
                [],
                500
            );
        }
    }

    /**
     * Crear un nuevo menú
     * POST /api/menu
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
                    return $this->errorResponse('El menú padre especificado no existe', [], 404);
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
                'Menú creado correctamente',
                201
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error al crear el menú: ' . $e->getMessage(),
                [],
                500
            );
        }
    }

    /**
     * Obtener un menú específico
     * GET /api/menu/{id}
     */
    public function show(Menu $menu)
    {
        try {
            return $this->successResponse(
                $menu->toHierarchical(),
                'Menú obtenido correctamente',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error al obtener el menú: ' . $e->getMessage(),
                [],
                500
            );
        }
    }

    /**
     * Actualizar un menú
     * PUT /api/menu/{id}
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
                    return $this->errorResponse('El menú padre especificado no existe', [], 404);
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
                'Menú actualizado correctamente',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error al actualizar el menú: ' . $e->getMessage(),
                [],
                500
            );
        }
    }

    /**
     * Eliminar un menú
     * DELETE /api/menu/{id}
     */
    public function destroy(Menu $menu)
    {
        try {
            // Si el menú tiene submenús, no permitir eliminación
            if ($menu->subMenus()->exists()) {
                return $this->errorResponse(
                    'No se puede eliminar un menú que contiene submenús',
                    [],
                    422
                );
            }

            $menu->delete();

            return $this->successResponse(
                null,
                'Menú eliminado correctamente',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error al eliminar el menú: ' . $e->getMessage(),
                [],
                500
            );
        }
    }

    /**
     * Obtener menús por sistema
     * GET /api/menu/by-system/{id_sistema}
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
                'Menús del sistema obtenidos correctamente',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error al obtener los menús del sistema: ' . $e->getMessage(),
                [],
                500
            );
        }
    }
}
