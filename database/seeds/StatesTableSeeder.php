<?php

use Illuminate\Database\Seeder;
use App\State;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['id' => '1','state' => 'Abia','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '2','state' => 'Adamawa','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '3','state' => 'Akwa Ibom','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '4','state' => 'Anambra','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '5','state' => 'Bauchi','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '6','state' => 'Bayelsa','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '7','state' => 'Benue','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '8','state' => 'Borno','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '9','state' => 'Cross River','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '10','state' => 'Delta','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '11','state' => 'Ebonyi','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '12','state' => 'Edo','status' => 1,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '13','state' => 'Ekiti','status' => 1,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '14','state' => 'Enugu','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '15','state' => 'Gombe','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '16','state' => 'Imo','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '17','state' => 'Jigawa','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '18','state' => 'Kaduna','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '19','state' => 'Kano','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '20','state' => 'Kastina','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '21','state' => 'Kebbi','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '22','state' => 'Kogi','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '23','state' => 'Kwara','status' => 1,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '24','state' => 'Lagos','status' => 1,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '25','state' => 'Nasarawa','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '26','state' => 'Niger','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '27','state' => 'Ogun','status' => 1,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '28','state' => 'Ondo','status' => 1,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '29','state' => 'Osun','status' => 1,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '30','state' => 'Oyo','status' => 1,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '31','state' => 'Plateau','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '32','state' => 'Rivers','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '33','state' => 'Sokoto','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '34','state' => 'Taraba','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '35','state' => 'Yobe','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '36','state' => 'Zamfara','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55'],
            ['id' => '37','state' => 'Federal Capital Territory','status' => 0,'created_at' => '2017-07-05 21:38:55','updated_at' => '2017-07-05 21:38:55']

        ];

        foreach($states as $key => $state){
           State::create($state);
        }
    }
}
