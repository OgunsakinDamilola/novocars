<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'fee_type_id',
        'value'
    ];

   public static function store($r){
           $fee = static::updateOrCreate([
               'fee_type_id' => $r->type_id
           ],[
               'value'   => $r->value
           ]);

           return $fee;
   }
}
