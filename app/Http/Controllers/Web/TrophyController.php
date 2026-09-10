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

        $productUrl = route('trophies.show', [
            'category' => $category->id,
            'product' => $product->id,
        ]);

        $whatsAppUrl = AppSetting::current()
            ->whatsAppUrl($productUrl."\n\nHello, I am interested in this product.");

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
        $products = Product::where('category_id', $category->id)
            ->latest('id')
            ->paginate(20)
            ->withQueryString();

        return $this->renderProductList($products, compact('category'));
    }

    public function newArrivals()
    {
        $category = null;
        $title = 'New Arrival';

        $products = Product::where('is_new_arrival', true)
            ->latest('id')
            ->paginate(20)
            ->withQueryString();

        return $this->renderProductList($products, compact('category', 'title'));
    }

    private function renderProductList($products, array $data)
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('trophies.partials.product-cards', compact('products'))->render(),
                'next_page_url' => $products->nextPageUrl(),
            ]);
        }

        return view('trophies.trophies', array_merge($data, compact('products')));
    }
}
