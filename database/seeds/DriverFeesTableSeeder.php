<?php

use Illuminate\Database\Seeder;
use App\DriverFee;
class DriverFeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driverFee = [
            'id'    => 1,
            'value' => 5000
        ];

        DriverFee::create($driverFee);
    }
}
