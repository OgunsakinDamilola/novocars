<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description'   => 'Owner of the system',
            ],
            [
                'name'         => 'customer',
                'display_name' => 'Customer',
                'description'  => 'A customer',
            ]
        ];

        foreach($roles as $key => $role)
              \App\Role::create($role);
    }
}
