<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'cpf',
        'barcode',
        'username',
        'key',
        'type',
        'service',
        'company',
        'manager'
    ];
}
