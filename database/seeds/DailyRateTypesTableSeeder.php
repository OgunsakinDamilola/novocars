<?php

use Illuminate\Database\Seeder;
use App\DailyRateTypes;

class DailyRateTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dailyRateTypes = [
            [
                'id'          => 1,
                'name'        => 'Within Lagos Metropolis',
                'fuel_status'  => 1,
                'description' => 'With in locations regarded as lagos metropolis by you. Car fueled',
            ],
            [
                'id'          => 2,
                'name'        => 'Within Lagos Metropolis',
                'fuel_status'  => 0,
                'description' => 'With in locations regarded as lagos metropolis by you. Car not fueled',
            ],
            [
                'id'          => 3,
                'name'        => 'Outside Lagos Metropolis',
                'fuel_status'  => 1,
                'description' => 'Outside locations regarded as lagos metropolis by you. Car fueled',
            ],
            [
                'id'          => 4,
                'name'        => 'Outside Lagos Metropolis',
                'fuel_status'  => 0,
                'description' => 'Outside locations regarded as lagos metropolis by you. Car not fueled',
            ],
            [
                'id'          => 5,
                'name'        => 'Extra Hour Rate',
                'fuel_status'  => 2,
                'description' => 'On failure to return vehicle after the allocated ending of the business day',
            ],
            [
                'id'          => 6,
                'name'        => 'Airport Pickup (Mainland)',
                'fuel_status'  => 2,
                'description' => 'Pickup From Airport to a location on the Mainland.',
            ],
            [
                'id'           => 7,
                'name'         => 'Airport Pickup (Island)',
                'fuel_status'  => 2,
                'description'  => 'Pickup From Airport to a location on the Island.',
            ],
            [
                'id'           => 8,
                'name'         => 'Drivers OutStation Fee',
                'fuel_status'  => 2,
                'description'  => 'Each time a driver sleep over with a vehicle',
            ]

        ];

        foreach($dailyRateTypes as $i => $dailyRateType){
            DailyRateTypes::create($dailyRateType);
        }
    }
}
