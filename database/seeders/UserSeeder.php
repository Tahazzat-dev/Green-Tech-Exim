<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',

            'phone' => '01700000000',

            'shop_name' => 'Admin Shop',

            'city_area' => 'Dhaka',

            'pin' => Hash::make('1234'),

            'status' => 'approved',

            'device_id' => 'web-admin',

            'role' => 'admin',
        ]);

        for ($i = 1; $i <= 20; $i++) {

            User::create([
                'name' => fake()->name(),

                'phone' => fake()->unique()->phoneNumber(),

                'shop_name' => fake()->company(),

                'city_area' => fake()->city(),

                'pin' => Hash::make('1234'),

                'status' => fake()->randomElement([
                    'approved',
                    'pending',
                    'blocked',
                ]),

                'device_id' => 'device-' . $i,

                'role' => 'user',
            ]);
        }
    }
}