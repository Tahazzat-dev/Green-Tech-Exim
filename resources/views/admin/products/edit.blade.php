@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

@include('partials.header')

<div class="custom-container max-w-5xl mx-auto p-4 py-7">

    <form
        action="{{ route('admin.products.update', $product) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-background border border-border rounded-xl p-5 space-y-6"
    >
        @csrf
        @method('PUT')

        <h1 class="font-semibold">
            Edit Product
        </h1>

        <div>
            <label class="block mb-2">Category</label>
            <select name="category_id" class="w-full rounded-lg border border-border bg-bg-body px-4 py-3">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2">Product Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >
        </div>

        <div class="space-y-3">
            <label class="block mb-2">Product Image</label>
            @if ($product->image)
                <div class="w-32 h-32 rounded-lg border border-border overflow-hidden bg-bg-body">
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-contain"
                    >
                </div>
            @endif
            <input
                type="file"
                name="image"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >
        </div>

        <div>
            <label class="block mb-2">Status</label>
            <select name="status" class="w-full rounded-lg border border-border bg-bg-body px-4 py-3">
                <option value="in_stock" @selected(old('status', $product->status) === 'in_stock')>In Stock</option>
                <option value="out_stock" @selected(old('status', $product->status) === 'out_stock')>Stock Out</option>
                <option value="limited" @selected(old('status', $product->status) === 'limited')>Limited</option>
            </select>
        </div>

        <div class="flex flex-wrap gap-6">
            <label class="flex items-center gap-3">
                <input
                    type="checkbox"
                    name="is_top_product"
                    value="1"
                    @checked(old('is_top_product', $product->is_top_product))
                >
                <span>Is Top Product</span>
            </label>

            <label class="flex items-center gap-3">
                <input
                    type="checkbox"
                    name="is_new_arrival"
                    value="1"
                    @checked(old('is_new_arrival', $product->is_new_arrival))
                >
                <span>New Arrival</span>
            </label>
        </div>

        <button type="submit" class="btn-primary px-6 py-3 rounded-lg">
            Update Product
        </button>
    </form>
</div>

@endsection
