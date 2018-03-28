<?php

use Illuminate\Database\Seeder;
use App\VehicleType;
class VehicleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleTypes = [
            [
                'id'          => 1,
                'category_id' => 1,
                'name'        => 'Toyota Corolla',
                'image_path'  => '/images/gallery/vehicles/1521292101Toyota Camry.jpg',
                'status'      => 0
            ],
            [
                'id'          => 2,
                'category_id' => 1,
                'name'        => 'Toyota Camry',
                'image_path'  => '/images/gallery/vehicles/1521292118Toyota Camry.jpg',
                'status'      => 0
            ],
            [
                'id'          => 3,
                'category_id' => 1,
                'name'        => 'Toyota Avensis',
                'image_path'  => '/images/gallery/vehicles/1521292130Toyota Camry.jpg',
                'status'      => 0
            ],
            [
                'id'          => 4,
                'category_id' => 4,
                'name'        => 'Nissan Almera',
                'image_path'  => '/images/gallery/vehicles/1521292141lexus Jeep.jpg',
                'status'      => 0
            ],
            [
                'id'          => 5,
                'category_id' => 1,
                'name'        => 'Mitsubishsi Pajero',
                'image_path'  => '/images/gallery/vehicles/1521292152Toyota Camry.jpg',
                'status'      => 0
            ],
            [
                'id'          => 6,
                'category_id' => 4,
                'name'        => 'Mitsubishsi Outlander',
                'image_path'  => '/images/gallery/vehicles/1521292163Home Jeep.jpg',
                'status'      => 0
            ],
            [
                'id'          => 7,
                'category_id' => 4,
                'name'        => 'Toyota Prado',
                'image_path'  => '/images/gallery/vehicles/1521451545Home Jeep.jpg',
                'status'      => 0
            ],
            [
                'id'          => 8,
                'category_id' => 4,
                'name'        => 'Toyota Landcruzzer',
                'image_path'  => '/images/gallery/vehicles/1521451567Home Jeep.jpg',
                'status'      => 0
            ],
            [
                'id'          => 9,
                'category_id' => 1,
                'name'        => 'Toyota Hilux',
                'image_path'  => '/images/gallery/vehicles/1521292181Home Car.jpg',
                'status'      => 0
            ],
            [
                'id'          => 10,
                'category_id' => 2,
                'name'        => 'Toyota Hiace',
                'image_path'  => '/images/gallery/vehicles/1521451580Hummer Bus.jpg',
                'status'      => 0
            ],
            [
                'id'          => 11,
                'category_id' => 3,
                'name'        => 'Toyota Coaster',
                'image_path'  => '/images/gallery/vehicles/1521292193Hummer Bus.jpg',
                'status'      => 0
            ]
        ];

        foreach($vehicleTypes as $serial => $vehicleType){
            VehicleType::create($vehicleType);
        }
    }
}
