<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'label',
        'icon',
        'link',
        'parent_key',
        'is_title',
        'collapsed',
        'id_sistema_pantalla',
        'order',
        'padre_id',
        'icon_id',
        'flag_detalle',
        'flag_visible',
        'id_sistema',
        'parent_menu_id',
        'bt_fecha',
        'bt_login',
    ];

    protected $casts = [
        'is_title' => 'boolean',
        'collapsed' => 'boolean',
        'flag_detalle' => 'boolean',
        'flag_visible' => 'boolean',
        'bt_fecha' => 'datetime',
    ];

    /**
     * Relación: Un menú pertenece a un menú padre
     */
    public function parentMenu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_menu_id');
    }

    /**
     * Relación: Un menú puede tener muchos submenús
     */
    public function subMenus(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_menu_id')
            ->orderBy('order', 'asc');
    }

    /**
     * Scope: Obtener solo menús raíz (sin padre)
     */
    public function scopeRootMenus($query)
    {
        return $query->whereNull('parent_menu_id')
            ->where('flag_visible', true)
            ->orderBy('order', 'asc');
    }

    /**
     * Scope: Obtener solo menús visibles
     */
    public function scopeVisible($query)
    {
        return $query->where('flag_visible', true);
    }

    /**
     * Convertir el menú a array con estructura jerárquica
     */
    public function toHierarchical(): array
    {
        return [
            'key' => $this->key,
            'label' => __($this->label),
            'icon' => $this->icon,
            'link' => $this->link,
            'parentKey' => $this->parent_key,
            'isTitle' => $this->is_title,
            'collapsed' => $this->collapsed,
            'idSistemaPantalla' => $this->id_sistema_pantalla,
            'order' => $this->order,
            'padreId' => $this->padre_id,
            'iconId' => $this->icon_id,
            'flagDetalle' => $this->flag_detalle,
            'flagVisible' => $this->flag_visible,
            'idSistema' => $this->id_sistema,
            'subMenu' => $this->subMenus->map(fn($submenu) => $submenu->toHierarchical())->toArray(),
            'btFecha' => $this->bt_fecha?->toIso8601String(),
            'btLogin' => $this->bt_login,
        ];
    }
}
