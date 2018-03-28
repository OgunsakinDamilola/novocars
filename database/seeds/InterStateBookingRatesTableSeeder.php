<?php

use Illuminate\Database\Seeder;
use App\InterStateBookingRate;

class InterStateBookingRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interStateBookingRates = [
            [
                'id'                      => 1,
                'destination_state_id'    => 12,
                'vehicle_category_id'     => 1,
                'state_rental_rate_value' => 60000,
                'status'                  => 1,
            ],
            [
                'id'                      => 2,
                'destination_state_id'    => 12,
                'vehicle_category_id'     => 2,
                'state_rental_rate_value' => 95000,
                'status'                  => 1,
            ],
            [
                'id'                      => 3,
                'destination_state_id'    => 12,
                'vehicle_category_id'     => 3,
                'state_rental_rate_value' => 180000,
                'status'                  => 1,
            ],
            [
                'id'                      => 4,
                'destination_state_id'    => 12,
                'vehicle_category_id'     => 4,
                'state_rental_rate_value' => 220000,
                'status'                  => 1,
            ],
            [
                'id'                      => 5,
                'destination_state_id'    => 13,
                'vehicle_category_id'     => 1,
                'state_rental_rate_value' => 50000,
                'status'                  => 1,
            ],
            [
                'id'                      => 6,
                'destination_state_id'    => 13,
                'vehicle_category_id'     => 2,
                'state_rental_rate_value' => 70000,
                'status'                  => 1,
            ],
            [
                'id'                      => 7,
                'destination_state_id'    => 13,
                'vehicle_category_id'     => 3,
                'state_rental_rate_value' => 135000,
                'status'                  => 1,
            ],
            [
                'id'                      => 8,
                'destination_state_id'    => 13,
                'vehicle_category_id'     => 4,
                'state_rental_rate_value' => 135000,
                'status'                  => 1,
            ],
            [
                'id'                      => 9,
                'destination_state_id'    => 23,
                'vehicle_category_id'     => 1,
                'state_rental_rate_value' => 50000,
                'status'                  => 1,
            ],
            [
                'id'                      => 10,
                'destination_state_id'    => 23,
                'vehicle_category_id'     => 2,
                'state_rental_rate_value' => 80000,
                'status'                  => 1,
            ],
            [
                'id'                      => 11,
                'destination_state_id'    => 23,
                'vehicle_category_id'     => 3,
                'state_rental_rate_value' => 150000,
                'status'                  => 1,
            ],
            [
                'id'                      => 12,
                'destination_state_id'    => 23,
                'vehicle_category_id'     => 4,
                'state_rental_rate_value' => 160000,
                'status'                  => 1,
            ],
            [
                'id'                      => 13,
                'destination_state_id'    => 27,
                'vehicle_category_id'     => 1,
                'state_rental_rate_value' => 20000,
                'status'                  => 1,
            ],
            [
                'id'                      => 14,
                'destination_state_id'    => 27,
                'vehicle_category_id'     => 2,
                'state_rental_rate_value' => 30000,
                'status'                  => 1,
            ],
            [
                'id'                      => 15,
                'destination_state_id'    => 27,
                'vehicle_category_id'     => 3,
                'state_rental_rate_value' => 50000,
                'status'                  => 1,
            ],
            [
                'id'                      => 16,
                'destination_state_id'    => 27,
                'vehicle_category_id'     => 4,
                'state_rental_rate_value' => 60000,
                'status'                  => 1,
            ],
            [
                'id'                      => 17,
                'destination_state_id'    => 28,
                'vehicle_category_id'     => 1,
                'state_rental_rate_value' => 40000,
                'status'                  => 1,
            ],
            [
                'id'                      => 18,
                'destination_state_id'    => 28,
                'vehicle_category_id'     => 2,
                'state_rental_rate_value' => 55000,
                'status'                  => 1,
            ],
            [
                'id'                      => 19,
                'destination_state_id'    => 28,
                'vehicle_category_id'     => 3,
                'state_rental_rate_value' => 100000,
                'status'                  => 1,
            ],
            [
                'id'                      => 20,
                'destination_state_id'    => 28,
                'vehicle_category_id'     => 4,
                'state_rental_rate_value' => 105000,
                'status'                  => 1,
            ],
            [
                'id'                      => 21,
                'destination_state_id'    => 29,
                'vehicle_category_id'     => 1,
                'state_rental_rate_value' => 35000,
                'status'                  => 1,
            ],
            [
                'id'                      => 22,
                'destination_state_id'    => 29,
                'vehicle_category_id'     => 2,
                'state_rental_rate_value' => 55000,
                'status'                  => 1,
            ],
            [
                'id'                      => 23,
                'destination_state_id'    => 29,
                'vehicle_category_id'     => 3,
                'state_rental_rate_value' => 100000,
                'status'                  => 1,
            ],
            [
                'id'                      => 24,
                'destination_state_id'    => 29,
                'vehicle_category_id'     => 4,
                'state_rental_rate_value' => 105000,
                'status'                  => 1,
            ],
            [
                'id'                      => 25,
                'destination_state_id'    => 30,
                'vehicle_category_id'     => 1,
                'state_rental_rate_value' => 25000,
                'status'                  => 1,
            ],
            [
                'id'                      => 26,
                'destination_state_id'    => 30,
                'vehicle_category_id'     => 2,
                'state_rental_rate_value' => 35000,
                'status'                  => 1,
            ],
            [
                'id'                      => 27,
                'destination_state_id'    => 30,
                'vehicle_category_id'     => 3,
                'state_rental_rate_value' => 60000,
                'status'                  => 1,
            ],
            [
                'id'                      => 28,
                'destination_state_id'    => 30,
                'vehicle_category_id'     => 4,
                'state_rental_rate_value' => 70000,
                'status'                  => 1,
            ],
        ];

        foreach($interStateBookingRates as $serial => $interStateBookingRate){
            InterStateBookingRate::create($interStateBookingRate);
        }
    }
}
