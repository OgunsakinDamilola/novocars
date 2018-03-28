<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverFee extends Model
{
    protected $fillable = [
      'id',
      'value'
    ];

    public static function store($r){
        $driverFee = static::updateOrCreate([
            'id' => 1,
        ],[
            'value' => $r->daily_driver_outstation_allowance_value
        ]);
        return $driverFee;
    }
}
