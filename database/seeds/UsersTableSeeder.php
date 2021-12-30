<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = \App\User::create([
            'first_name'  => 'super',
            'last_name'   =>  'admin',
            'email'       => 'super_admin@gmail.com',
            'password'    => Hash::make('123456789'),
        ]);

        $user->attachRole('super_admin');
    }
}
