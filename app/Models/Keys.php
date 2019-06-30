<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keys extends Model
{
    protected $fillable = [
        'name',
        'barcode',
        'sector_id',
        'type_id'
    ];

    /**
     * @param $barcode
     */
    public function ifExists($barcode)
    {
        $data = Keys::where('barcode', $barcode);
        if(!$data){
            return "Não existe";
        }

        return "Já cadastrado!";
    }
}
