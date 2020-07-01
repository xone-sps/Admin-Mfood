<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            //'logo' => 'logo_default.png',
            'email_verified_at' => '2020-05-03 00:00:00',
            'password' => Hash::make('admin@2020'),
            'user_type' => 'Admin',
            'status_user' => 'Approved',
        ]);

        
    }
}
