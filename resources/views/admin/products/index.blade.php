@extends('layouts.app')

@section('title', 'Products')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <div class="flex items-center justify-between mb-6">

        <h1 class="font-semibold">
            Products
        </h1>

        <a
            href="{{ route('admin.products.create') }}"
            class="btn-primary px-4 py-2 rounded-lg"
        >
            Add Product
        </a>

    </div>

    <div class="grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))] gap-5">

        @forelse($products as $product)

            <div class="rounded-xl border border-border bg-background overflow-hidden shadow-sm">

                <div class="aspect-square bg-bg-body p-4">

                    <img
                        src="{{ $product->image ? asset('storage/' . $product->image) : Vite::asset('resources/images/trophy-big.png') }}"
                        class="w-full h-full object-contain"
                    >

                </div>

                <div class="p-4">

                    <div class="flex items-center justify-between">

                        <h3 class="font-semibold">
                            {{ $product->name }}
                        </h3>

                        @if($product->is_top_product)
                            <span class="text-xs px-2 py-1 rounded bg-yellow-500 text-white">
                                Top
                            </span>
                        @endif

                    </div>

                    <p class="text-sm text-text-body mt-1">
                        {{ $product->category?->name }}
                    </p>

                    <div class="mt-3">

                        <span class="text-sm px-2 py-1 rounded
                            {{ $product->status === 'in_stock'
                                ? 'bg-green-500 text-white'
                                : 'bg-red-500 text-white'
                            }}"
                        >
                            {{ str_replace('_', ' ', $product->status) }}
                        </span>

                    </div>

                    <div class="flex gap-2 mt-4">

                        <a
                            href="{{ route('admin.products.show', $product) }}"
                            class="px-3 py-2 rounded bg-slate-700 text-white text-sm"
                        >
                            View
                        </a>

                        <a
                            href="{{ route('admin.products.edit', $product) }}"
                            class="px-3 py-2 rounded bg-blue-500 text-white text-sm"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.products.destroy', $product) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete product?')"
                                class="px-3 py-2 rounded bg-red-500 text-white text-sm"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full text-center py-10">
                No products found.
            </div>

        @endforelse

    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>

@endsection