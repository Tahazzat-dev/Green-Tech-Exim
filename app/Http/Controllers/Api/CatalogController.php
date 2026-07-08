<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CatalogController extends Controller
{
    public function categories()
    {
        $categories = Category::latest()
            ->get()
            ->map(fn (Category $category) => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'image_url' => $this->imageUrl(
                    $category->image,
                    'images/trophy-big.png'
                ),
            ]);

        return response()->json([
            'data' => $categories,
        ]);
    }

    public function products(Request $request, Category $category)
    {
        $mobileUser = $this->mobileUser($request);
        $priceVisible = $mobileUser !== null;

        $products = Product::with('variants')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(20);

        return response()->json([
            'price_visible' => $priceVisible,
            'data' => $products
                ->getCollection()
                ->map(fn (Product $product) => $this->productPayload(
                    $product,
                    $mobileUser
                ))
                ->values(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
        ]);
    }

    public function product(
        Request $request,
        Category $category,
        Product $product
    ) {
        if ($product->category_id !== $category->id) {
            abort(404);
        }

        $product->load('variants');

        $mobileUser = $this->mobileUser($request);

        return response()->json([
            'price_visible' => $mobileUser !== null,
            'data' => $this->productPayload(
                $product,
                $mobileUser,
                true
            ),
        ]);
    }

    public function contacts()
    {
        $contacts = Contact::where('status', true)
            ->latest()
            ->get()
            ->map(fn (Contact $contact) => [
                'id' => $contact->id,
                'name' => $contact->name,
                'designation' => $contact->designation,
                'phone' => $contact->phone,
                'image_url' => $this->imageUrl(
                    $contact->profile,
                    'images/user-placeholder.png'
                ),
            ]);

        return response()->json([
            'data' => $contacts,
        ]);
    }

    private function productPayload(
        Product $product,
        ?User $user,
        bool $includeDescription = false
    ): array {
        $payload = [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'name' => $product->name,
            'slug' => $product->slug,
            'image_url' => $this->imageUrl(
                $product->image,
                'images/trophy-big.png'
            ),
            'status' => $product->status,
            'is_top_product' => (bool) $product->is_top_product,
            'variants' => $product->variants
                ->map(fn ($variant) => $this->variantPayload(
                    $variant,
                    $user
                ))
                ->values(),
        ];

        if ($includeDescription) {
            $payload['description'] = $product->description;
        }

        return $payload;
    }

    private function variantPayload($variant, ?User $user): array
    {
        $payload = [
            'id' => $variant->id,
            'label' => $variant->label,
            'size' => $variant->size,
        ];

        if (! $user) {
            return $payload;
        }

        $discountPercent = $user->discount ?? 0;
        $amount = (float) $variant->amount;
        $finalPrice = $amount - (($amount * $discountPercent) / 100);

        return array_merge($payload, [
            'amount' => $amount,
            'final_price' => round($finalPrice, 2),
            'discount_percent' => $discountPercent,
        ]);
    }

    private function mobileUser(Request $request): ?User
    {
        $token = $request->bearerToken();

        if (! $token) {
            return null;
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (! $accessToken) {
            return null;
        }

        $user = $accessToken->tokenable;

        if (
            ! $user instanceof User ||
            $user->role !== 'user' ||
            $user->status !== 'approved'
        ) {
            return null;
        }

        return $user;
    }

    private function imageUrl(?string $path, string $fallback): string
    {
        if (! $path) {
            return asset($fallback);
        }

        return asset('storage/'.$path);
    }
}
