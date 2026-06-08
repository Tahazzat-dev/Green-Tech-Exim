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

        foreach ($categories as $category) {

            for ($i = 1; $i <= rand(5,10); $i++) {

                Product::create([
                    'category_id' => $category->id,

                    'name' => $category->name.' '.$i,

                    'slug' => Str::slug(
                        $category->name.' '.$i
                    ),

                    'description' => fake()->paragraph(5),

                    'image' => null,

                    'status' => fake()->randomElement([
                        'in_stock',
                        'out_stock',
                    ]),

                    'is_top_product' => fake()->boolean(),
                ]);
            }
        }
    }
}
