<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{

    protected $fillable = [
        'booking_id',
        'reference',
        'amount',
        'response_code',
        'response_description',
        'response_full',
        'payment_status',
        'user_id'
    ];

    public static function store($data){
        $onlinePayment = static::updateOrCreate([
            'reference' => $data['reference'],
            'booking_id' => $data['booking_id'],
        ],[
            'user_id'   => auth()->user()->id,
            'amount'    => $data['amount'],
            'response_code' => array_get($data,'response_code','0'),
            'response_description' => array_get($data,'response_description','0'),
            'response_full' => array_get($data,'response_full','0'),
            'payment_status' => array_get($data,'payment_status','0'),
        ]);

        return $onlinePayment;
    }
}
