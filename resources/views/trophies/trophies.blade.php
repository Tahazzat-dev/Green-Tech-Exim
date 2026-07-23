@extends('layouts.app')
@section('title', 'Trophies')
@section('content')
@include("partials.header")
<div class="custom-container flex-1 flex flex-col  mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10 h-full">
    <!-- page title -->
   <div class="w-full flex items-center">
    <button
        type="button"
        onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.href = '{{ route('categories.all') }}'; }"
        class="md:hidden"
    >
        <svg class="min-w-5 size-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z"/></svg>
    </button>
    <h1 class="text-center font-semibold flex-1 md:flex-none md:mx-auto" >{{$category->name ?? "All Trophies"}} </h1>
    <div class="md:hidden min-w-5 size-6"></div>
   </div>

   <!-- page content -->
    <div class="w-full pt-5 md:pt-7 gap-4 md:gap-5 grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))]">

        @php
            $userDiscount = auth()->user()?->discount ?? 0;
        @endphp

       @forelse ($products as $product)
            <!-- Trophy card -->
            <a  href="{{ route('trophies.show', [
                    'category' => $category->id,
                    'product' => $product->id
                ]) }}" 
            class="flex flex-col items-center gap-2 lg:gap-3 p-3 sm:p-4 rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border">

                <div class="relative aspect-square w-full">
                    <img
                    src="{{
                        $product->image
                            ? asset('storage/' . $product->image)
                            : asset('images/trophy-big.png')
                    }}"
                    alt="{{ $product->name }}"
                    class="h-full w-full object-contain drop-shadow-lg"
                    referrerPolicy="no-referrer"
                    />
                </div>
            
                <div class="w-full flex items-center justify-center gap-3">
                    <div class="flex gap-2.5 text-center">
                            <div class="w-3 relative">
                                <div class="leading-[100%] text-xs sm:text-[13px] absolute bg-green-600 px-1 pt-0.5 md:py-0.5 -rotate-90 -left-5.5 top-1/2 -translate-y-1/2 font-semibold text-white" >
                                    <p class="text-xs sm:text-[13px] text-white">MODEL</p>
                                </div>
                            </div>
                           <div class="flex flex-col text-sm sm:text-base text-red-700 font-bold">
                                @php
                                    $nameParts = explode(' ', strtoupper($product->name));
                                @endphp

                                @foreach ($nameParts as $part)

                                    <span class="leading-[110%]">
                                        {{ $part }}
                                    </span>

                                @endforeach
                            </div>
                    </div>

                   <!-- Variants -->
                    <div class="w-fit max-w-24 border-l-2 border-red-700">

                        @php
                            $variantCount = $product->variants->count();
                        @endphp

                        @if ($variantCount > 1)
                            @foreach ($product->variants as $variant)
                                <div class="w-full border-b-2 px-1 sm:px-3 py-0.5 font-semibold border-red-700">
                                    <p class="text-xs sm:text-[14px]">
                                        {{ $variant->label }}
                                        @if ($variant->size)
                                            {{ $variant->size }}"
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        @elseif ($variantCount === 1)
                        <div class="w-full border-b-2 px-1 sm:px-3 font-semibold border-red-700">
                            <p class="opacity-0 leading-[100%]" >#</p>
                        </div>
                            <div class="w-full border-b-2 border-red-700 px-1 sm:px-3 py-0.5 font-semibold">
                                    <p class="text-xs pt-0.5 sm:text-[14px]">
                                        Size
                                        @if ($product->variants[0]->size)
                                            {{ $product->variants[0]->size }}"
                                        @endif
                                    </p>
                                </div>
                        <div class="w-full px-1 sm:px-3font-semibold">
                            <p class="opacity-0 leading-[100%]" >#</p>
                        </div>
                        @else
                            <div class="w-full px-2 py-1">
                                <p class="text-xs text-center">
                                    No Size
                                </p>
                            </div>
                        @endif

                        @if ($variantCount > 1)

                            <!-- Extra Bottom Divider -->
                            <div class="w-full font-semibold">
                                <p class="opacity-0 text-xxs">#</p>
                            </div>
                         @endif
                    </div>
                </div>
          
                @auth
                    <!-- Prices -->
                    <div class="flex mb-1 font-semibold gap-3 flex-wrap justify-center items-center">

                        @forelse ($product->variants as $variant)

                            @php
                                $discountAmount = ($variant->amount * $userDiscount) / 100;

                                $finalPrice = $variant->amount - $discountAmount;
                            @endphp

                            <h5 class="text-xs sm:text-base text-center">

                                {{ $variant->label }} {{ number_format($finalPrice) }} Tk

                            </h5>

                        @empty

                            <h5 class="text-sm text-center">
                                No Price
                            </h5>

                        @endforelse

                    </div>
                @endauth

                @guest
                    <div class="flex mb-1 font-semibold justify-center items-center">
                        <h5 class="text-xs sm:text-base text-center">
                            Login for price details.
                        </h5>
                    </div>
                @endguest
                <span class="
                text-sm sm:text-base inline-block font-semibold py-1 px-3 md:py-2 md:px-5 rounded-sm
                {{
                    $product->status === 'in_stock'
                        ? 'text-primary bg-primary/20'
                        : 'text-red-600 bg-red-100 dark:bg-red-900/30'
                }}
                ">

                    {{
                        $product->status === 'in_stock'
                            ? 'In Stock'
                            : 'Out of Stock'
                    }}

                </span>
            </a>
            <!-- Trophy card -->
        @empty

            <div class="col-span-full text-center py-10">

                <p class="text-text-body">
                    No trophies found.
                </p>

            </div>

        @endforelse
    </div>
</div>
@endsection
