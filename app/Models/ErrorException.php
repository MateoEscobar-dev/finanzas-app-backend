<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorException extends Model
{
    use HasFactory;
    protected $table = "error_exception";
    protected $fillable=['id_log', 'type','message', 'params','endpoint','result'];
}
