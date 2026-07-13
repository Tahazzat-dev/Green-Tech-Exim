<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
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

        $contact = Contact::where('status', true)
            ->where('designation', 'Owner')
            ->oldest()
            ->first();

        $whatsAppPhone = null;

        if ($contact) {
            $phone = preg_replace('/\D+/', '', $contact->phone);

            if (str_starts_with($phone, '0')) {
                $phone = '880'.substr($phone, 1);
            }

            $whatsAppPhone = $phone;
        }

        return view(
            'trophies.show',
            compact(
                'category',
                'product',
                'whatsAppPhone'
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
