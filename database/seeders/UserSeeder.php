<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new \App\Models\User;
        $newUser->name =  'Admin';
        $newUser->username = 'admin';
        $newUser->password = \Hash::make('123456');
        $newUser->save();
    }
}
