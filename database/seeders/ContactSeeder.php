<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $designations = [
            'Manager',
            'Sales Executive',
            'Owner',
            'Support Officer',
            'Marketing Head',
        ];

        for ($i = 1; $i <= 12; $i++) {

            Contact::create([
                'name' => fake()->name(),

                'designation' => fake()->randomElement(
                    $designations
                ),

                'phone' => fake()->phoneNumber(),

                'profile' => null,

                'status' => fake()->boolean(90),
            ]);
        }
    }
}
