<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Muhammad Andra Fahreza',
            'email' => 'andrafahreza818@gmail.com',
            'password' => bcrypt('12345678'),
            'id_profile' => '1'
        ]);
    }
}
