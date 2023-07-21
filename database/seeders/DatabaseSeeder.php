<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        UserType::create([
            'type' => 'Administrator'
        ]);

        UserType::create([
            'type' => 'User'
        ]);

        User::create([
            'user_type_id' => 1,
            'name' => 'Administrator',
            'phone_number' => 7016588443,
            'email' => 'nandvadera25@gmail.com',
            'password' => Hash::make('secret12345'),
            'verified' => 1,
        ]);

    }
}
