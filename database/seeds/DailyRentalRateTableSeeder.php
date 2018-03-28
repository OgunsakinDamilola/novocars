<?php

use Illuminate\Database\Seeder;
use App\DailyRentalRate;

class DailyRentalRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dailyRentalRates = [
            [
                'vehicle_type_id' => 1,
                'daily_rental_within_lagos_metropolis_with_fuel' => 17000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 12000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 17000,
                'rate_per_extra_hour' => 1500,
                'airport_pick_up_drop_off_main_land' => 6000,
                'airport_pick_up_drop_off_island' => 7000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 2,
                'daily_rental_within_lagos_metropolis_with_fuel' => 18000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 15000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 22000,
                'rate_per_extra_hour' => 2000,
                'airport_pick_up_drop_off_main_land' => 8000,
                'airport_pick_up_drop_off_island' => 8000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 3,
                'daily_rental_within_lagos_metropolis_with_fuel' => 20000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 17000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 22000,
                'rate_per_extra_hour' => 2500,
                'airport_pick_up_drop_off_main_land' => 10000,
                'airport_pick_up_drop_off_island' => 10000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 4,
                'daily_rental_within_lagos_metropolis_with_fuel' => 17000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 13000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 17000,
                'rate_per_extra_hour' => 1500,
                'airport_pick_up_drop_off_main_land' => 6000,
                'airport_pick_up_drop_off_island' => 7000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 5,
                'daily_rental_within_lagos_metropolis_with_fuel' => 25000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 22000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 27000,
                'rate_per_extra_hour' => 2500,
                'airport_pick_up_drop_off_main_land' => 15000,
                'airport_pick_up_drop_off_island' => 18000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 6,
                'daily_rental_within_lagos_metropolis_with_fuel' => 30000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 20000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 25000,
                'rate_per_extra_hour' => 2500,
                'airport_pick_up_drop_off_main_land' => 12000,
                'airport_pick_up_drop_off_island' => 14000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 7,
                'daily_rental_within_lagos_metropolis_with_fuel' => 40000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 35000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 40000,
                'rate_per_extra_hour' => 3000,
                'airport_pick_up_drop_off_main_land' => 25000,
                'airport_pick_up_drop_off_island' => 25000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 8,
                'daily_rental_within_lagos_metropolis_with_fuel' => 45000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 40000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 45000,
                'rate_per_extra_hour' => 3500,
                'airport_pick_up_drop_off_main_land' => 30000,
                'airport_pick_up_drop_off_island' => 30000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 9,
                'daily_rental_within_lagos_metropolis_with_fuel' => 25000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 20000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 18000,
                'rate_per_extra_hour' => 2500,
                'airport_pick_up_drop_off_main_land' => 10000,
                'airport_pick_up_drop_off_island' => 12000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 10,
                'daily_rental_within_lagos_metropolis_with_fuel' => 30000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 25000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 25000,
                'rate_per_extra_hour' => 2500,
                'airport_pick_up_drop_off_main_land' => 15000,
                'airport_pick_up_drop_off_island' => 18000,
                'status' => 1,
            ],
            [
                'vehicle_type_id' => 11,
                'daily_rental_within_lagos_metropolis_with_fuel' => 45000,
                'daily_rental_within_lagos_metropolis_without_fuel' => 35000,
                'daily_rental_outside_lagos_metropolis_without_fuel' => 40000,
                'rate_per_extra_hour' => 3000,
                'airport_pick_up_drop_off_main_land' => 25000,
                'airport_pick_up_drop_off_island' => 28000,
                'status' => 1,
            ],
        ];
        foreach($dailyRentalRates as $serial => $dailyRentalRate){
            DailyRentalRate::create($dailyRentalRate);
        }
    }
}
