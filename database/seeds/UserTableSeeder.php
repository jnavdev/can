<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App\User::create([
    		'rut' => '19.099.876-2',
    		'full_name' => 'Jorge Navarro',
    		'email' => 'coke.navarro12@gmail.com',
    		'password' => bcrypt('123456'),
    		'profile_picture' => '/uploads/users/avatar.png',
    		'role_id' => 1
    	]);

        App\User::create([
            'rut' => '17.296.231-9',
            'full_name' => 'Diego Altamirano',
            'email' => 'd.altamirano.estrada@gmail.com',
            'password' => bcrypt('123456'),
            'profile_picture' => '/uploads/users/avatar.png',
            'role_id' => 1
        ]);

        App\User::create([
            'rut' => '10.636.453-2',
            'full_name' => 'Julio Millar',
            'email' => 'juliomillarc@gami.cl',
            'password' => bcrypt('123456'),
            'profile_picture' => '/uploads/users/avatar.png',
            'role_id' => 1
        ]);
    }
}
