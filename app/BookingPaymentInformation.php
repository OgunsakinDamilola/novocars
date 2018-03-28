<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingPaymentInformation extends Model
{

    protected $fillable = [
        'booking_id',
        'driver_outstation_fee',
        'duration',
        'vehicle_state_price',
        'daily_rental_rate_amount',
        'total_amount',
        'payment_status',
        'booking_status',
        'discount'
    ];

    public static function store($data){

        $bookingPaymentInformation = static::updateOrCreate(
        [
            'booking_id' => $data['booking_id'],
        ],
        [
            'driver_outstation_fee'            => array_get($data,'driver_outstation_fee',0),
            'duration'                         => array_get($data,'duration',1),
            'vehicle_state_price'              => array_get($data,'vehicle_state_price'),
            'daily_rental_rate_amount'         => array_get($data, 'daily_rental_rate_amount'),
            'total_amount'                     => array_get($data,'total_amount'),
            'discount'                         => array_get($data,'discount',0),
            'payment_status'                   => 0,
            'booking_status'                   => array_get($data,'booking_status',2)
        ]);

        return $bookingPaymentInformation;
    }

}
