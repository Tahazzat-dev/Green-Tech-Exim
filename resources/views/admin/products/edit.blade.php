@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

@include('partials.header')

<div class="custom-container max-w-5xl mx-auto p-4 py-7">

    <form
        action="{{ route('admin.products.update', $product) }}"
        method="POST"
        enctype="multipart/form-data"
        x-data='{
            variants: @json($product->variants)
        }'
        class="bg-background border border-border rounded-xl p-5 space-y-6"
    >

        @csrf
        @method('PUT')

        <h1 class="font-semibold">
            Edit Product
        </h1>

        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name) }}"
            class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
        >

        <textarea
            name="description"
            rows="5"
            class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
        >{{ old('description', $product->description) }}</textarea>

        <div class="space-y-4">

            <template x-for="(variant, index) in variants" :key="index">

                <div class="border border-border rounded-xl p-4">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <input
                            :name="'variants[' + index + '][label]'"
                            x-model="variant.label"
                            class="rounded-lg border border-border bg-bg-body px-4 py-3"
                        >

                        <input
                            type="number"
                            :name="'variants[' + index + '][amount]'"
                            x-model="variant.amount"
                            class="rounded-lg border border-border bg-bg-body px-4 py-3"
                        >

                        <input
                            type="number"
                            :name="'variants[' + index + '][discount_price]'"
                            x-model="variant.discount_price"
                            class="rounded-lg border border-border bg-bg-body px-4 py-3"
                        >

                        <input
                            type="text"
                            :name="'variants[' + index + '][size_inch]'"
                            x-model="variant.size_inch"
                            class="rounded-lg border border-border bg-bg-body px-4 py-3"
                        >

                    </div>

                </div>

            </template>

        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Update Product
        </button>

    </form>

</div>

@endsection