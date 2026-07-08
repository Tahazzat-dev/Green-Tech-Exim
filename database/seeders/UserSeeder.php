<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $phoneNumbers = [
            '01711234567', '01712345678', '01301234567', '01302345678', '01713456789',
            '01911234567', '01912345678', '01401234567', '01402345678', '01913456789',
            '01671234567', '01672345678', '01611234567', '01612345678', '01673456789'
        ];

        // 1. Randomize the order of the phone numbers array up front
        shuffle($phoneNumbers);

        // Admin creation
        User::create([
            'name' => 'Admin',
            'phone' => '01700000000',
            'shop_name' => 'Admin Shop',
            'discount' => 5,
            'city_area' => 'Dhaka',
            'pin' => Hash::make('1234'),
            'plain_pin' => '1234',
            'status' => 'approved',
            'device_id' => 'web-admin',
            'device_change_allowed' => false,
            'role' => 'admin',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $uniquePhone = array_pop($phoneNumbers);

            User::create([
                'name' => fake()->name(),
                'phone' => $uniquePhone, 
                'discount' => fake()->numberBetween(1, 10),
                'shop_name' => fake()->company(),
                'city_area' => fake()->city(),
                'pin' => Hash::make('1234'),
                'plain_pin' => '1234',
                'status' => fake()->randomElement([
                    'approved',
                    'pending',
                    'blocked',
                ]),
                'device_id' => 'device-'.$i,
                'device_change_allowed' => false,
                'role' => 'user',
            ]);
        }
    }
}
