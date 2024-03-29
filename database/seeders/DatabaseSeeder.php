<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'robiokidenis@gmail.com',
            'password' => bcrypt('password'),
            'account_type' => 1

        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@grtech.com.my',
            'password' => bcrypt('password'),
            'account_type' => 1

        ]);
        User::create([
            'name' => 'user',
            'email' => 'auser@grtech.com.my',
            'password' => bcrypt('password'),
            'account_type' => 0

        ]);
    }
}
