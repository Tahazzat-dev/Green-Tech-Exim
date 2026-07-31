@extends('layouts.app')

@section('title', 'Product Details')

@section('content')

@include('partials.header')

@php
    $statusClasses = match ($product->status) {
        'in_stock' => 'bg-green-500 text-white',
        'limited' => 'text-yellow-600 bg-yellow-100 dark:text-yellow-400 dark:bg-yellow-900/30',
        default => 'bg-red-500 text-white',
    };

    $statusLabel = match ($product->status) {
        'in_stock' => 'In Stock',
        'limited' => 'Limited',
        default => 'Stock Out',
    };
@endphp

<div class="custom-container max-w-6xl mx-auto p-4 py-7">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-background border border-border rounded-xl p-5">
            <img
                src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/trophy-small.jpeg') }}"
                class="w-full object-contain rounded-xl"
                alt="{{ $product->name }}"
            >
        </div>

        <div class="bg-background border border-border rounded-xl p-5">
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="font-bold text-2xl">
                    {{ $product->name }}
                </h1>

                @if($product->is_top_product)
                    <span class="px-2 py-1 rounded bg-yellow-500 text-white text-xs">
                        Top Product
                    </span>
                @endif

                @if($product->is_new_arrival)
                    <span class="px-2 py-1 rounded bg-blue-500 text-white text-xs">
                        New Arrival
                    </span>
                @endif
            </div>

            <div class="mt-6 space-y-3">
                <p>
                    <strong>Category:</strong>
                    {{ $product->category?->name }}
                </p>

                <p>
                    <strong>Status:</strong>
                    <span class="text-sm px-2 py-1 rounded {{ $statusClasses }}">
                        {{ $statusLabel }}
                    </span>
                </p>

                <p>
                    <strong>Slug:</strong>
                    {{ $product->slug }}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
