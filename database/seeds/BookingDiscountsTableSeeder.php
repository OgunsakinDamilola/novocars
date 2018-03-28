<?php

use Illuminate\Database\Seeder;
use App\BookingDiscount;

class BookingDiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookingDiscounts = [
          [
              'id'      => 1,
              'days'    => 5,
              'value'   => 10000,
              'status'  => 0
          ],
          [
              'id'      => 2,
              'days'    => 10,
              'value'   => 15000,
              'status'  => 0
          ],
          [
              'id'      => 3,
              'days'    => 15,
              'value'   => 20000,
              'status'  => 0
          ],

        ];

        foreach($bookingDiscounts as $serial => $bookingDiscount){
            BookingDiscount::create($bookingDiscount);
        }
    }
}
