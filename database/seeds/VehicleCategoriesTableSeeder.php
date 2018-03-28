<?php

use Illuminate\Database\Seeder;
use App\VehicleCategory;

class VehicleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle_categories = [
            [
                'id'    => 1,
                'name'  =>  'CAR',
            ],
            [
                'id'    => 2,
                'name'  =>  'HIACE',
            ],
            [
                 'id'   => 3,
                 'name' =>  'COASTER',
            ],
            [
                 'id'   => 4,
                 'name' => 'SUV',
            ]
        ];

        foreach($vehicle_categories as $serial => $vehicle_category){
            VehicleCategory::create($vehicle_category);
        }
    }
}
