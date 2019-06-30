<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keys extends Model
{
    protected $table = 'keys';

    protected $fillable = [
        'name',
        'barcode',
        'sector_id',
        'type_id'
    ];

}
