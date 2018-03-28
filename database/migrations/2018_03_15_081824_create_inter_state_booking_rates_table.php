<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterStateBookingRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inter_state_booking_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('destination_state_id');
            $table->integer('vehicle_category_id');
            $table->integer('state_rental_rate_value');
            $table->integer('status');
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
        Schema::dropIfExists('inter_state_booking_rates');
    }
}
