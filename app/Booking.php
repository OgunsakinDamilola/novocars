<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'id',
        'user_id',
        'destination_state_id',
        'start_date',
        'end_date',
        'pick_up_address',
        'vehicle_type_id',
        'use_car',
        'fuel',
        'within_lagos_metro',
        'payment_status',
        'booking_status'
    ];

    public static function store($r){

        $booking = static::updateOrCreate(
        [
          'id' => $r['id'],
        ],
        [
            'destination_state_id' => $r['destination_state_id'],
            'user_id'              => auth()->user()->id,
            'start_date'           => $r['start_date'],
            'end_date'             => $r['end_date'],
            'pick_up_address'      => $r['pick_up_address'],
            'vehicle_type_id'      => $r['vehicle_type'],
            'use_car'              => array_get($r,'use_car',0),
            'fuel'                 => array_get($r,'fuel',0),
            'within_lagos_metro'   => array_get($r,'within_lagos_metro',0),
            'payment_status'       => 0,
            'booking_status'       => array_get($r,'booking_status', 2),
        ]);

        return $booking;
    }

}
