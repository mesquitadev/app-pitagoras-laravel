<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestUsers extends Model
{
    protected $fillable = [
        'cpf',
        'name',
        'phone1',
        'phone2'
    ];
}
