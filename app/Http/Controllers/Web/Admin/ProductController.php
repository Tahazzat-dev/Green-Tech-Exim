<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'in:in_stock,out_stock',
            ],

            'is_top_product' => [
                'nullable',
                'boolean',
            ],

            'image' => [
                'nullable',
                File::image()->max(2048),
            ],

            'variants' => [
                'required',
                'array',
                'min:1',
            ],

            'variants.*.label' => [
                'required',
            ],

            'variants.*.amount' => [
                'required',
                'numeric',
            ],

            'variants.*.discount_price' => [
                'nullable',
                'numeric',
            ],

            'variants.*.size_inch' => [
                'nullable',
            ],
        ]);

        DB::beginTransaction();

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
                'description' => $validated['description'],
                'status' => $validated['status'],
                'is_top_product' => $request->boolean('is_top_product'),
                'image' => $imagePath,
            ]);

            foreach ($validated['variants'] as $variant) {

                $product->variants()->create([
                    'label' => $variant['label'],
                    'amount' => $variant['amount'],
                    'discount_price' => $variant['discount_price'] ?? null,
                    'size_inch' => $variant['size_inch'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with(
                    'success',
                    'Product created successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ])
                ->withInput();
        }
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'variants',
        ]);

        return view(
            'admin.products.show',
            compact('product')
        );
    }

    public function edit(Product $product)
    {
        $categories = Category::latest()->get();

        $product->load('variants');

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
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'in:in_stock,out_stock',
            ],

            'variants' => [
                'required',
                'array',
            ],
        ]);

        DB::beginTransaction();

        try {

            $data = [
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'description' => $validated['description'],
                'status' => $validated['status'],
                'is_top_product' => $request->boolean('is_top_product'),
            ];

            if ($request->hasFile('image')) {

                $data['image'] = $request
                    ->file('image')
                    ->store('products', 'public');
            }

            $product->update($data);

            $product->variants()->delete();

            foreach ($request->variants as $variant) {

                $product->variants()->create([
                    'label' => $variant['label'],
                    'amount' => $variant['amount'],
                    'discount_price' => $variant['discount_price'] ?? null,
                    'size_inch' => $variant['size_inch'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with(
                    'success',
                    'Product updated successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

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
