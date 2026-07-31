<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('slug', 'LIKE', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {

                            $categoryQuery->where(
                                'name',
                                'LIKE',
                                "%{$search}%"
                            );

                        });

                });

            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view(
            'admin.products.index',
            compact('products')
        );
    }

    public function create()
    {
        $categories = Category::latest()->get();

        return view(
            'admin.products.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:in_stock,out_stock,limited',
            ],

            'is_top_product' => [
                'nullable',
                'boolean',
            ],

            'is_new_arrival' => [
                'nullable',
                'boolean',
            ],

            'image' => [
                'nullable',
                File::image()->max(2048),
            ],
        ]);

        try {

            $imagePath = null;

            if ($request->hasFile('image')) {

                $imagePath = $request
                    ->file('image')
                    ->store('products', 'public');
            }

            $product = Product::create([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'status' => $validated['status'],
                'is_top_product' => $request->boolean('is_top_product'),
                'is_new_arrival' => $request->boolean('is_new_arrival'),
                'image' => $imagePath,
            ]);

            return redirect()
                ->route('admin.products.index')
                ->with(
                    'success',
                    'Product created successfully.'
                );

        } catch (\Exception $e) {

            return back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ])
                ->withInput();
        }
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view(
            'admin.products.show',
            compact('product')
        );
    }

    public function edit(Product $product)
    {
        $categories = Category::latest()->get();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        Product $product
    ) {

        $validated = $request->validate([
            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'status' => [
                'nullable',
                'in:in_stock,out_stock,limited',
            ],

            'image' => [
                'nullable',
                File::image()->max(2048),
            ],
        ]);

        try {

            $data = [
                'category_id' => $validated['category_id'] ?? $product->category_id,
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'status' => $validated['status'] ?? $product->status,
                'is_top_product' => $request->boolean('is_top_product'),
                'is_new_arrival' => $request->boolean('is_new_arrival'),
            ];

            if ($request->hasFile('image')) {

                $data['image'] = $request
                    ->file('image')
                    ->store('products', 'public');
            }

            $product->update($data);

            return redirect()
                ->route('admin.products.index')
                ->with(
                    'success',
                    'Product updated successfully.'
                );

        } catch (\Exception $e) {

            return back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }
}
