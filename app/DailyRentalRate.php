<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyRentalRate extends Model
{

    protected $fillable = [
        'vehicle_type_id',
        'daily_rental_within_lagos_metropolis_with_fuel',
        'daily_rental_within_lagos_metropolis_without_fuel',
        'daily_rental_outside_lagos_metropolis_without_fuel',
        'rate_per_extra_hour',
        'airport_pick_up_drop_off_main_land',
        'airport_pick_up_drop_off_island',
        'status'
    ];

    public static function store($r){
        $dailyRentalRate = static::updateOrCreate(
        [
            'vehicle_type_id' => $r->vehicle_type_id,
        ],
        [
            'daily_rental_within_lagos_metropolis_with_fuel'      => $r->daily_rental_within_lagos_metropolis_with_fuel,
            'daily_rental_within_lagos_metropolis_without_fuel'   => $r->daily_rental_within_lagos_metropolis_without_fuel,
            'daily_rental_outside_lagos_metropolis_without_fuel'  => $r->daily_rental_outside_lagos_metropolis_without_fuel,
            'rate_per_extra_hour'                                 => $r->rate_per_extra_hour,
            'airport_pick_up_drop_off_main_land'                  => $r->airport_pick_up_drop_off_main_land,
            'airport_pick_up_drop_off_island'                     => $r->airport_pick_up_drop_off_island,
            'status'                                              => 1,
        ]);

        return $dailyRentalRate;
    }

}
