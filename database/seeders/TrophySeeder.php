<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Trophy; // <-- Updated Model name
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrophySeeder extends Seeder // <-- Renamed Class
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {

            for ($i = 1; $i <= rand(5, 10); $i++) {

                Trophy::create([ // <-- Updated Model execution
                    'category_id' => $category->id,

                    'name' => $category->name.' Trophy '.$i, // <-- Updated naming slightly to fit context

                    'slug' => Str::slug(
                        $category->name.' Trophy '.$i
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