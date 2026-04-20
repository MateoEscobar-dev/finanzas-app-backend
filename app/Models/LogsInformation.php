<?php

namespace App\Models;

use App\Traits\EncryptableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsInformation extends Model
{
    use HasFactory, EncryptableTrait;

    protected $encryptable = ['field', 'value', 'new'];

    protected $fillable = [
        'id_log',
        'id_register',
        'field',
        'value',
        'new',
    ];
}
