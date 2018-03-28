<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDiscount extends Model
{
    protected $fillable = [
        'id',
        'days',
        'value',
        'status'
    ];

    public static function store($r){
        $bookingDiscount = static::updateOrCreate(
        [
            'days' => $r->booking_days
        ],
        [
            'value' => $r->discount_value,
            'status' => 0
        ]);

        return $bookingDiscount;
    }
}
