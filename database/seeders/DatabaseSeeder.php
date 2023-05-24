<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\user_types;
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

        user_types::create([
            'type' => 'Administrator'
        ]);

        user_types::create([
            'type' => 'User'
        ]);

        User::create([
            'user_type_id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret')
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
