<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'barcode',
        'cpf',
        'username',
        'phone',
        'key',
        'type',
        'service',
        'company',
        'manager',
        'concierge'
    ];
}
