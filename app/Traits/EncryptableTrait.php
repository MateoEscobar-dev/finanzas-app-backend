<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait EncryptableTrait {
    protected static function bootEncryptableTrait()
    {
        // Evento "retrieved" que se dispara cada vez que se recupera un modelo de la base de datos
        static::retrieved(function ($model) {
            foreach ($model->encryptable as $attribute) {
                if(!empty($model->{$attribute})){
                    $model->{$attribute} = self::decryptData($model->{$attribute});
                }
            }
        });

        // Evento "saving" que se dispara cada vez que se esta guardando en la base de datos
        static::saving(function ($model) {
            foreach ($model->encryptable as $attribute) {
                if ($model->isDirty($attribute) && !empty($model->{$attribute})) {
                    $model->{$attribute} = self::encryptData($model->{$attribute});
                }
            }
        });
    }

    public static function decryptData($encripted){
		$excKey = config('app.exc_key');
        try {
            $result = DB::select("select decryptData(?, ?) as data", [$encripted, $excKey]);
            $decrypt_value = $result[0]->data ?? $encripted;
            return $decrypt_value;
        } catch (\Throwable $th) {
            return $encripted;
        }
	}

    public static function encryptData($data)
    {
        $excKey = config('app.exc_key');
        try {
            $result = DB::select("select encryptData(?, ?) as data", [$data, $excKey]);
            $encrypt_value = $result[0]->data ?? $data;
            return $encrypt_value;
        } catch (\Throwable $th) {
            return $data;
        }

    }
    public function decrypt($encripted){
		$excKey = config('app.exc_key');
        try {
            $result = DB::select("select decryptData(?, ?) as data", [$encripted, $excKey]);
            $decrypt_value = $result[0]->data ?? $encripted;
            return $decrypt_value;
        } catch (\Throwable $th) {
            return $encripted;
        }
	}

    public function encrypt($data)
    {
        $excKey = config('app.exc_key');
        try {
            $result = DB::select("select encryptData(?, ?) as data", [$data, $excKey]);
            $encrypt_value = $result[0]->data ?? $data;
            return $encrypt_value;
        } catch (\Throwable $th) {
            return $data;
        }

    }
}
