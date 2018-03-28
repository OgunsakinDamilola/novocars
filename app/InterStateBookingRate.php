<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterStateBookingRate extends Model
{
    protected $fillable = [
        'id',
        'destination_state_id',
        'vehicle_category_id',
        'state_rental_rate_value',
        'status',
    ];

    public static function store($r){
        $interStateBooking = static::updateOrCreate(
        [
            'destination_state_id' => $r->destination_state_id,
            'vehicle_category_id'  => $r->vehicle_category_id,
        ],
        [
            'state_rental_rate_value' => $r->state_rental_rate_value,
            'status'                  => 0
        ]);
        return $interStateBooking;
    }

}
