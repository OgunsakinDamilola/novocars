<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('destination_state_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->longText('pick_up_address');
            $table->integer('vehicle_type_id');
            $table->integer('use_car')->default(0);
            $table->integer('fuel')->default(0);
            $table->integer('within_lagos_metro')->defualt(0);
            $table->integer('payment_status')->default(0);
            $table->integer('booking_status')->defualt(0);
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
        Schema::dropIfExists('bookings');
    }

}
