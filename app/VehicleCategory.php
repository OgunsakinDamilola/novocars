<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];

    public static function store($r){
        $vehicleCategory = static::updateOrCreate(
        [
            'id'  => $r->vehicle_category_id
        ],
        [
            'name' => $r->vehicle_category
        ]);

        return $vehicleCategory;
    }


}
