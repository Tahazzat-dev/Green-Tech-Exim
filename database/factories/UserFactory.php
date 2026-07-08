<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current PIN being used by the factory.
     */
    protected static ?string $pin;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pin = '1234';

        return [
            'name' => fake()->name(),
            'phone' => fake()->unique()->numerify('01#########'),
            'shop_name' => fake()->company(),
            'city_area' => fake()->city(),
            'discount' => fake()->numberBetween(0, 10),
            'photo' => null,
            'pin' => static::$pin ??= Hash::make($pin),
            'plain_pin' => $pin,
            'status' => 'approved',
            'device_id' => 'factory-'.fake()->unique()->uuid(),
            'device_change_allowed' => false,
            'role' => 'user',
            'remember_token' => fake()->regexify('[A-Za-z0-9]{10}'),
        ];
    }

    /**
     * Indicate that the user is waiting for admin approval.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'status' => 'approved',
        ]);
    }
}
