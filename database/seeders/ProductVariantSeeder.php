<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {

            $variants = 2;

            for ($i = 1; $i <= $variants; $i++) {

                $price = rand(500, 5000);

                ProductVariant::create([
                    'product_id' => $product->id,

                    'label' => chr(64 + $i),

                    'amount' => $price,

                    'discount_price' => $price - rand(50, 300),

                    'size' => rand(5, 25).' Inch',
                ]);
            }
        }
    }
}
