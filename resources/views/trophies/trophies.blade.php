@extends('layouts.app')
@section('title', $title ?? ($category->name ?? 'Products'))
@section('content')
@include("partials.header")

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10 h-full">
   <div class="w-full flex items-center">
    <button
        type="button"
        onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.href = '{{ route('categories.all') }}'; }"
        class="md:hidden"
    >
        <svg class="min-w-5 size-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z"/></svg>
    </button>
    <h1 class="text-center font-semibold flex-1 md:flex-none md:mx-auto">{{ $title ?? ($category->name ?? 'Products') }}</h1>
    <div class="md:hidden min-w-5 size-6"></div>
   </div>

    <div class="w-full pt-5 md:pt-7 gap-4 md:gap-5 grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(250px,1fr))]">
       @forelse ($products as $product)
            @php
                $statusClasses = match ($product->status) {
                    'in_stock' => 'text-primary bg-primary/20',
                    'limited' => 'text-yellow-600 bg-yellow-100 dark:text-yellow-400 dark:bg-yellow-900/30',
                    default => 'text-red-600 bg-red-100 dark:bg-red-900/30',
                };

                $statusLabel = match ($product->status) {
                    'in_stock' => 'In Stock',
                    'limited' => 'Limited',
                    default => 'Stock Out',
                };
            @endphp

            @auth
                <a
                    href="{{ route('trophies.show', [
                        'category' => $product->category_id,
                        'product' => $product->id
                    ]) }}"
                    class="flex flex-col items-center rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border"
                >
            @else
                <button
                    type="button"
                    @click="guestProductModalOpen = true"
                    class="flex flex-col items-center rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border text-left"
                >
            @endauth
            <img
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/trophy-small.jpeg') }}"
                        alt="{{ $product->name }}"
                        class="rounded-lg"
                        referrerPolicy="no-referrer"
                    />
                <!-- <div class="overflow-hidden relative aspect-square w-full">
                    @if($product->is_top_product)
                        <span class="absolute top-2.5 right-2.5 z-10 text-xs px-2 py-1 rounded bg-yellow-500 text-white shrink-0">
                            Top
                        </span>
                    @endif
                    
                </div> -->
                <div class="w-full p-3 sm:p-4 flex flex-col gap-2">
                    @auth
                        <h3 class="w-full text-center text-sm sm:text-base font-bold text-text-body line-clamp-2">
                            {{ $product->name }}
                        </h3>
                    @else
                        <h3 class="w-full text-center text-sm sm:text-base font-bold text-text-body">
                            Login to view price
                        </h3>
                    @endauth

                <span class="text-sm inline-block font-semibold py-1 px-3 text-center md:px-5 rounded-sm {{ $statusClasses }}">
                    {{ $statusLabel }}
                </span>
                </div>
            @auth
                </a>
            @else
                </button>
            @endauth
        @empty
            <div class="col-span-full text-center py-10">
                <p class="text-text-body">
                    No products found.
                </p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
