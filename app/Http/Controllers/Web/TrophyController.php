<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Category;
use App\Models\Product;

class TrophyController extends Controller
{
    public function categories()
    {
        $categories = Category::latest()
            ->get();

        return view(
            'categories.categories',
            compact('categories')
        );
    }

    public function show(Category $category, Product $product)
    {
        // optional safety check
        if (
            $product->category_id !== $category->id
        ) {
            abort(404);
        }

        $whatsAppUrl = AppSetting::current()
            ->whatsAppUrl('Hello, I am interested in '.$product->name.'.');

        return view(
            'trophies.show',
            compact(
                'category',
                'product',
                'whatsAppUrl'
            )
        );
    }

    public function all(Category $category)
    {
        $products = Product::with('variants')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(20);

        return view(
            'trophies.trophies',
            compact(
                'category',
                'products'
            )
        );
    }
}
