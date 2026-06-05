<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Plastic Trophy',
            'Crystal Trophy',
            'Metal Trophy',
            'Wooden Trophy',
            'Sports Trophy',
            'Corporate Award',
            'Champion Cup',
            'Medals',
        ];

        foreach ($categories as $category) {

            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}