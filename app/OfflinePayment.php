<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfflinePayment extends Model
{

    protected $fillable = [
        'user_id',
        'booking_id',
        'reference',
        'amount',
        'payment_status'
    ];

    public static function store($data){
        $offilePayment = static::updateOrCreate([
            'user_id'        => auth()->user()->id,
            'booking_id'     => $data['booking_id'],
            'reference'      => $data['reference'],
        ],[
            'amount'         => $data['amount'],
            'payment_status' => $data['payment_status'],
        ]);
        return $offilePayment;
    }
}
