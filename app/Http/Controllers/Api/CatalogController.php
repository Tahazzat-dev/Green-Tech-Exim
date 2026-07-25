<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Category;
use App\Models\Contact;
use App\Models\PrivacyPolicy;
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
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($productQuery) use ($search) {
                    $productQuery
                        ->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('slug', 'LIKE', "%{$search}%");
                });
            })
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

    public function topProducts(Request $request)
    {
        $mobileUser = $this->mobileUser($request);

        $products = Product::with('variants')
            ->where('is_top_product', true)
            ->latest()
            ->paginate(20);

        return response()->json([
            'price_visible' => $mobileUser !== null,
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

    public function contacts()
    {
        $contacts = Contact::where('status', true)
            ->latest()
            ->get()
            ->map(fn (Contact $contact) => $this->contactPayload($contact));

        return response()->json([
            'data' => $contacts,
        ]);
    }

    public function ownerContact()
    {
        $contact = Contact::where('status', true)
            ->where('designation', 'Owner')
            ->oldest()
            ->first();

        if (! $contact) {
            return response()->json([
                'data' => null,
                'message' => 'No owner contact found.',
            ], 404);
        }

        return response()->json([
            'data' => $this->contactPayload($contact),
        ]);
    }

    public function settings()
    {
        $settings = AppSetting::current();

        return response()->json([
            'data' => [
                'whatsapp_phone' => $settings->whatsapp_phone,
                'whatsapp_url' => $settings->whatsAppUrl(),
                'facebook_page_url' => $settings->facebook_page_url,
            ],
        ]);
    }

    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::current();

        return response()->json([
            'data' => [
                'title' => $privacyPolicy->title,
                'content' => $privacyPolicy->content,
                'updated_at' => $privacyPolicy->updated_at,
            ],
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

    private function contactPayload(Contact $contact): array
    {
        return [
            'id' => $contact->id,
            'name' => $contact->name,
            'designation' => $contact->designation,
            'phone' => $contact->phone,
            'whatsapp_phone' => $this->normalizedPhone($contact->phone),
            'image_url' => $this->imageUrl(
                $contact->profile,
                'images/user-placeholder.png'
            ),
        ];
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

    private function normalizedPhone(?string $phone): ?string
    {
        if (! $phone) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $phone);

        if (! $phone) {
            return null;
        }

        if (str_starts_with($phone, '0')) {
            return '880'.substr($phone, 1);
        }

        return $phone;
    }
}
