<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('name', '=', 'admin')->first();

        $customer_role = Role::where('name', '=', 'customer')->first();

        $admin = User::create([
            'first_name' => 'Novo',
            'middle_name' => 'Car',
            'last_name' => 'Rentals',
            'phone' => ' 07088604232',
            'address' => '',
            'profile_photo' => '',
            'email'=>'admin@novocars.com',
            'password'=> bcrypt('admin')
        ]);

        $customer = User::create([
            'first_name' => 'Novo',
            'middle_name' => 'First',
            'last_name' => 'Customer',
            'phone' => '09080008000',
            'address' => '',
            'profile_photo' => '',
            'email'=>'customer@novocars.com',
            'password'=> bcrypt('customer')
        ]);

        $admin->attachRole($admin_role);
        $customer->attachRole($customer_role);
    }
}
