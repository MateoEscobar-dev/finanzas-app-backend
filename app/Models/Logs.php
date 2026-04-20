<?php

namespace App\Models;

use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class Logs extends Model
{
    use HasFactory, LogTrait;

    protected $fillable = [
        'table',
        'id_item',
        'operation',
        'reason',
        'user',
        'date',
        'type'
    ];

    public function usuario(){
        return $this->hasOne(User::class,  'id', 'user');
    }
    public function toArray()
    {
        $attributes = parent::toArray();
        $attributes['action'] = $this->makeLog($this);
        $attributes['reason'] = __($attributes['reason']);
        $attributes['operation'] = $this->makeOperation($this->operation);
        $attributes['operation'] = str_replace(["% ", "TO: ", "REASON: "], [": ", __("TO: "), __("REASON: ")], $attributes['operation']);
        return $attributes;
    }

    public function toObject()
    {
        try {
            $attributes = $this->toArray();

            // Agregar los campos adicionales
            $attributes['action'] = $this->makeLog($this);
            $attributes['operation'] = $this->makeOperation($this->operation);

            // Convertir a objeto
            return json_decode(json_encode($attributes));    //code...
        } catch (\Throwable $th) {
            //throw $th;
            //Log::error($th);
        }

    }
}
