@extends('layouts.app')

@section('title', 'Create Product')

@section('content')

@include('partials.header')

<div class="custom-container max-w-5xl mx-auto p-4 py-7">

    <form
        action="{{ route('admin.products.store') }}"
        method="POST"
        enctype="multipart/form-data"
        x-data="productVariants()"
        class="bg-background border border-border rounded-xl p-5 space-y-6"
    >

        @csrf

        <h1 class="font-semibold">
            Create Product
        </h1>

        <!-- Category -->
        <div>

            <label class="block mb-2">
                Category
            </label>

            <select
                name="category_id"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

                <option value="">
                    Select Category
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <!-- Name -->
        <div>

            <label class="block mb-2">
                Product Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        <!-- Description -->
        <div>

            <label class="block mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="5"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >{{ old('description') }}</textarea>

        </div>

        <!-- Image -->
        <div>

            <label class="block mb-2">
                Product Image
            </label>

            <input
                type="file"
                name="image"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        <!-- Status -->
        <div>

            <label class="block mb-2">
                Status
            </label>

            <select
                name="status"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

                <option value="in_stock">
                    In Stock
                </option>

                <option value="out_stock">
                    Out Stock
                </option>

            </select>

        </div>

        <!-- Top Product -->
        <div class="flex items-center gap-3">

            <input
                type="checkbox"
                name="is_top_product"
                value="1"
            >

            <label>
                Is Top Product
            </label>

        </div>

        <!-- Variants -->
        <div>

            <div class="flex items-center justify-between mb-4">

                <h3 class="font-semibold">
                    Product Variants
                </h3>

                <button
                    type="button"
                    @click="addVariant()"
                    class="px-4 py-2 rounded-lg bg-primary text-white"
                >
                    Add Variant
                </button>

            </div>

            <div class="space-y-4">

                <template x-for="(variant, index) in variants" :key="index">

                    <div class="border border-border rounded-xl p-4 space-y-4">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <input
                                :name="'variants[' + index + '][label]'"
                                x-model="variant.label"
                                placeholder="Price Label"
                                class="rounded-lg border border-border bg-bg-body px-4 py-3"
                            >

                            <input
                                type="number"
                                :name="'variants[' + index + '][amount]'"
                                x-model="variant.amount"
                                placeholder="Price"
                                class="rounded-lg border border-border bg-bg-body px-4 py-3"
                            >

                            <input
                                type="number"
                                :name="'variants[' + index + '][discount_price]'"
                                x-model="variant.discount_price"
                                placeholder="Discount Price"
                                class="rounded-lg border border-border bg-bg-body px-4 py-3"
                            >

                            <input
                                type="text"
                                :name="'variants[' + index + '][size_inch]'"
                                x-model="variant.size_inch"
                                placeholder="Size"
                                class="rounded-lg border border-border bg-bg-body px-4 py-3"
                            >

                        </div>

                        <button
                            type="button"
                            @click="removeVariant(index)"
                            class="px-4 py-2 rounded-lg bg-red-500 text-white"
                        >
                            Remove
                        </button>

                    </div>

                </template>

            </div>

        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Create Product
        </button>

    </form>

</div>

<script>

function productVariants() {

    return {

        variants: [
            {
                label: '',
                amount: '',
                discount_price: '',
                size_inch: '',
            }
        ],

        addVariant() {

            this.variants.push({
                label: '',
                amount: '',
                discount_price: '',
                size_inch: '',
            });

        },

        removeVariant(index) {

            this.variants.splice(index, 1);

        }

    }

}

</script>

@endsection