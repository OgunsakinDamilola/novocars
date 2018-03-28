<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingPaymentInformation extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('booking_payment_informations',function (Blueprint $table){
            $table->increments('id');
            $table->integer('booking_id');
            $table->integer('driver_outstation_fee');
            $table->integer('duration')->default(1);
            $table->integer('vehicle_state_price');
            $table->integer('daily_rental_rate_amount');
            $table->integer('discount');
            $table->integer('total_amount');
            $table->integer('payment_status')->defualt(0);
            $table->integer('booking_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('booking_payment_informations');
    }
}
