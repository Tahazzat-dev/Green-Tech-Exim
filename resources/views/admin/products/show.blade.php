@extends('layouts.app')

@section('title', 'Product Details')

@section('content')

@include('partials.header')

<div class="custom-container max-w-6xl mx-auto p-4 py-7">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <div class="bg-background border border-border rounded-xl p-5">

            <img
                src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/trophy-big.png') }}"
                class="w-full object-contain rounded-xl"
            >

        </div>

        <div class="bg-background border border-border rounded-xl p-5">

            <div class="flex items-center gap-3">

                <h1 class="font-bold text-2xl">
                    {{ $product->name }}
                </h1>

                @if($product->is_top_product)

                    <span class="px-2 py-1 rounded bg-yellow-500 text-white text-xs">
                        Top Product
                    </span>

                @endif

            </div>

            <p class="mt-3 text-text-body">
                {{ $product->description }}
            </p>

            <div class="mt-6 space-y-2">

                <p>
                    <strong>Category:</strong>
                    {{ $product->category?->name }}
                </p>

                <p>
                    <strong>Status:</strong>
                    {{ str_replace('_', ' ', $product->status) }}
                </p>

                <p>
                    <strong>Slug:</strong>
                    {{ $product->slug }}
                </p>

            </div>

            <!-- Variants -->

            <div class="mt-8">

                <h3 class="font-semibold mb-4">
                    Product Variants
                </h3>

                <div class="space-y-4">

                    @foreach($product->variants as $variant)

                        <div class="border border-border rounded-xl p-4">

                            <div class="grid grid-cols-2 gap-4">

                                <div>
                                    <p class="text-sm text-text-body">
                                        Label
                                    </p>

                                    <h4 class="font-semibold">
                                        {{ $variant->label }}
                                    </h4>
                                </div>

                                <div>
                                    <p class="text-sm text-text-body">
                                        Amount
                                    </p>

                                    <h4 class="font-semibold">
                                        {{ $variant->amount }}
                                    </h4>
                                </div>

                                <div>
                                    <p class="text-sm text-text-body">
                                        Discount Price
                                    </p>

                                    <h4 class="font-semibold">
                                        {{ $variant->discount_price ?? '-' }}
                                    </h4>
                                </div>

                                <div>
                                    <p class="text-sm text-text-body">
                                        Size
                                    </p>

                                    <h4 class="font-semibold">
                                        {{ $variant->size ?? '-' }}
                                    </h4>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
