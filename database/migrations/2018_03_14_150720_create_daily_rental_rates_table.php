<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyRentalRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_rental_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_type_id');
            $table->integer('daily_rental_within_lagos_metropolis_with_fuel');
            $table->integer('daily_rental_within_lagos_metropolis_without_fuel');
            $table->integer('daily_rental_outside_lagos_metropolis_without_fuel');
            $table->integer('rate_per_extra_hour');
            $table->integer('airport_pick_up_drop_off_main_land');
            $table->integer('airport_pick_up_drop_off_island');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('daily_rental_rates');
    }
}
