<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(VehicleCategoriesTableSeeder::class);
        $this->call(VehicleTypesTableSeeder::class);
        $this->call(BookingDiscountsTableSeeder::class);
        $this->call(DailyRateTypesTableSeeder::class);
        $this->call(DailyRentalRateTableSeeder::class);
        $this->call(DriverFeesTableSeeder::class);
        $this->call(InterStateBookingRatesTableSeeder::class);
    }
}
