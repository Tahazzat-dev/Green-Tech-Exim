<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
$faker = \Faker\Factory::create();

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {

            for ($i = 1; $i <= rand(5,10); $i++) {

                $name = sprintf(
                    'Price: A %d tk, B %d tk, C %d tk.',
                    rand(800, 5000),
                    rand(800, 5000),
                    rand(800, 5000)
                );

                Product::create([
                    'category_id' => $category->id,

                    'name' => $name,

                    'slug' => Str::slug($name),

                    'image' => null,

                    'status' => fake()->randomElement([
                        'in_stock',
                        'out_stock',
                        'limited',
                    ]),

                    'is_top_product' => fake()->boolean(),

                    'is_new_arrival' => fake()->boolean(),
                ]);
            }
        }
    }
}
