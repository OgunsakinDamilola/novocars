<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'image_path',
        'status'
    ];

    public static function store($r){
        $image = $r->file('vehicle_image');
        $imageName = time().$image->getClientOriginalName();
        $image_path = '/images/gallery/vehicles/'.$imageName;
        $image->move(public_path('/images/gallery/vehicles/'),$imageName);

           $vehicleType = static::create([
               'category_id' => array_get($r,'vehicle_category_id'),
               'name'        => array_get($r,'','vehicle_name'),
               'image_path'  => $image_path,
               'status'      => 0
           ]);

           return $vehicleType;
    }

}
