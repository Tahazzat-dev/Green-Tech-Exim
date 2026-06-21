@extends('layouts.app')

@section('title', 'Products')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">
<!-- Header -->
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-6">

    <div class="flex justify-between items-center">
        <h1 class="font-semibold">
        Products
    </h1>
    <a
            href="{{ route('admin.products.create') }}"
            class="sm:hidden btn-primary px-4 py-2 rounded-lg whitespace-nowrap text-center"
        >
            Add Product
        </a>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

        <!-- Search Form -->
        <form
            action="{{ route('admin.products.index') }}"
            method="GET"
            class="flex items-center w-full pr-1.5 md:w-[320px] rounded-lg overflow-hidden border border-border bg-bg-body"
        >
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search products..."
                class="w-full bg-transparent px-4 py-1.5 outline-none text-text-body"
            >
            <button
                type="submit"
                class="rounded-full btn btn-primary p-1 shrink-0"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35M16 10.5A5.5 5.5 0 1 1 5 10.5a5.5 5.5 0 0 1 11 0Z"
                    />
                </svg>
            </button>

        </form>

        <!-- Add Product -->
        <a
            href="{{ route('admin.products.create') }}"
            class="hidden sm:block btn-primary px-4 py-2 rounded-lg whitespace-nowrap text-center"
        >
            Add Product
        </a>

    </div>

</div>

<!-- Search Result -->
@if(request('search'))

    <div class="mb-5">

        <p class="text-sm text-text-body">

            Search result for:

            <span class="font-semibold">
                "{{ request('search') }}"
            </span>

        </p>

    </div>

@endif

<!-- Products Grid -->
<div class="grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))] gap-5">

    @forelse($products as $product)

        <div class="rounded-xl border border-border bg-background overflow-hidden shadow-sm">

            <!-- Product Image -->
            <div class="aspect-square relative bg-bg-body w-full p-4 max-h-56">

                <img
                    src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/trophy-big.png') }}"
                    class="w-full h-full object-contain"
                    alt="{{ $product->name }}"
                >


                @if($product->is_top_product)

                        <span class="absolute top-2.5 right-2.5 text-xs px-2 py-1 rounded bg-yellow-500 text-white shrink-0">
                            Top
                        </span>

                    @endif
            </div>

            <!-- Product Info -->
            <div class="p-4">

                <div class="flex items-start justify-between gap-2">

                    <h3 class="font-semibold line-clamp-2">
                        {{ $product->name }}
                    </h3>
                </div>

                <!-- Category -->
                <p class="text-sm text-text-body mt-1">

                    {{ $product->category?->name }}

                </p>

                <!-- Status -->
                <div class="mt-3">

                    <span
                        class="text-sm px-2 py-1 rounded
                        {{ $product->status === 'in_stock'
                            ? 'bg-green-500 text-white'
                            : 'bg-red-500 text-white'
                        }}"
                    >

                        {{ str_replace('_', ' ', ucfirst($product->status)) }}

                    </span>

                </div>

                <!-- Actions -->
                <div class="flex flex-wrap gap-2 mt-4">

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
                            type="submit"
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

        <div class="col-span-full text-center py-14">

            <h3 class="font-semibold text-lg">
                No products found
            </h3>

            @if(request('search'))

                <p class="text-text-body mt-2">
                    Try searching with another keyword.
                </p>

            @endif

        </div>

    @endforelse

</div>

<!-- Pagination -->
<div class="mt-8">

    {{ $products->withQueryString()->links() }}

</div>
</div>

@endsection
