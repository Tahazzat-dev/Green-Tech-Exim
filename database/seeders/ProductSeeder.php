<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $now = now();

        foreach ($categories as $category) {
            $count = rand(5, 10) * 20;
            $rows = [];

            for ($i = 1; $i <= $count; $i++) {
                $name = sprintf(
                    'Price: A %d tk, B %d tk, C %d tk.',
                    rand(800, 5000),
                    rand(800, 5000),
                    rand(800, 5000)
                );

                $rows[] = [
                    'category_id' => $category->id,
                    'name' => $name,
                    'slug' => Str::slug($name).'-'.$category->id.'-'.$i,
                    'image' => null,
                    'status' => fake()->randomElement([
                        'in_stock',
                        'out_stock',
                        'limited',
                    ]),
                    'is_top_product' => fake()->boolean(),
                    'is_new_arrival' => fake()->boolean(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            Product::insert($rows);
        }
    }
}
