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
            variants: @json($product->variants),
            addVariant() {
                this.variants.push({
                    label: "",
                    size: "",
                    amount: "",
                    discount_price: ""
                });
            },
            removeVariant(index) {
                this.variants.splice(index, 1);
            }
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

                    <div class="border border-border rounded-xl relative p-4 space-y-4">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div class="flex flex-col gap-2">
                                <label>Variant Label</label>
                                <input
                                :name="'variants[' + index + '][label]'"
                                x-model="variant.label"
                                placeholder="ex: A or B"
                                class="rounded-lg border border-border bg-bg-body px-4 py-3"
                                >
                            </div>

                             <div class="flex flex-col gap-2">
                                <label>Variant Size (inch)</label>
                                <input
                                type="text"
                                :name="'variants[' + index + '][size]'"
                                x-model="variant.size"
                                placeholder="ex: 28"
                                class="rounded-lg border border-border bg-bg-body px-4 py-3"
                            >
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <label>Price</label>
                                <input
                                type="number"
                                :name="'variants[' + index + '][amount]'"
                                x-model="variant.amount"
                                placeholder="Price"
                                class="rounded-lg border border-border bg-bg-body px-4 py-3"
                                >
                            </div>

                             
                           

                            <!-- <input
                                type="number"
                                :name="'variants[' + index + '][discount_price]'"
                                x-model="variant.discount_price"
                                placeholder="Discount Price"
                                class="rounded-lg border border-border bg-bg-body px-4 py-3"
                            > -->

                           
                        </div>

                        <button
                            type="button"
                            @click="removeVariant(index)"
                            class="absolute top-0 right-0 p-2 bg-red-100 text-red-600 rounded-full hover:bg-red-200/70"
                        >
                        <svg class="size-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M232.7 69.9C237.1 56.8 249.3 48 263.1 48L377 48C390.8 48 403 56.8 407.4 69.9L416 96L512 96C529.7 96 544 110.3 544 128C544 145.7 529.7 160 512 160L128 160C110.3 160 96 145.7 96 128C96 110.3 110.3 96 128 96L224 96L232.7 69.9zM128 208L512 208L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 208zM216 272C202.7 272 192 282.7 192 296L192 488C192 501.3 202.7 512 216 512C229.3 512 240 501.3 240 488L240 296C240 282.7 229.3 272 216 272zM320 272C306.7 272 296 282.7 296 296L296 488C296 501.3 306.7 512 320 512C333.3 512 344 501.3 344 488L344 296C344 282.7 333.3 272 320 272zM424 272C410.7 272 400 282.7 400 296L400 488C400 501.3 410.7 512 424 512C437.3 512 448 501.3 448 488L448 296C448 282.7 437.3 272 424 272z"/></svg>
                        </button>

                    </div>

                </template>

        </div>

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
