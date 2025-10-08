<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@halobun.test'],
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
            ]
        );

        $this->call([
            VideoSeeder::class,
            FaqSeeder::class,
            FacilitySeeder::class,
        ]);
    }
}
