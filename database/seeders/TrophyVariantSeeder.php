<?php

namespace Database\Seeders;

use App\Models\Trophy;       
use App\Models\TrophyVariant;
use Illuminate\Database\Seeder;

class TrophyVariantSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Fetch all trophies instead of products
        $trophies = Trophy::all();

        foreach ($trophies as $trophy) {

            $variants = 2;

            for ($i = 1; $i <= $variants; $i++) {

                $price = rand(500, 5000);

                TrophyVariant::create([
                    'trophy_id' => $trophy->id,
                    'label' => 'Price '.chr(64 + $i),

                    'amount' => $price,

                    'discount_price' => $price - rand(50, 300),

                    'size' => rand(5, 25).' Inch',
                ]);
            }
        }
    }
}