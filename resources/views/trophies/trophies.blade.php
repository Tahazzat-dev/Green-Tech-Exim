@extends('layouts.app')
@section('title', 'Trophies')
@section('content')
@include("partials.header")
<div class="custom-container flex-1 flex flex-col  mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10 h-full">
    <!-- page title -->
   <div class="w-full flex lg:justify-center">
    <h1 class="text-center font-semibold" >{{$category->name ?? "All Trophies"}} </h1>
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
                            : Vite::asset('resources/images/trophy-big.png')
                    }}"
                    alt="{{ $product->name }}"
                    class="h-full w-full object-contain drop-shadow-lg"
                    referrerPolicy="no-referrer"
                    />
                </div>
            
                <div class="w-full flex items-center justify-center gap-3">
                    <div class="flex gap-2.5 text-center">
                            <div class="w-3 relative">
                                <p class="leading-[100%] text-xs sm:text-[13px] absolute bg-red-700 px-1 pt-0.5 -rotate-90 -left-5.5 top-1/2 -translate-y-1/2 font-semibold text-white" >MODEL</p>
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
                        <!-- <div class="flex flex-col text-sm sm:text-base text-red-700 font-bold">
                            <span class="leading-[110%]" >RYAL</span>
                            <span class="leading-[110%]" >GLORY</span>
                        </div> -->
                    </div>

                   <!-- Variants -->
                    <div class="w-fit max-w-20 border-l-2 border-red-700">

                        @forelse ($product->variants as $variant)

                            <div class="w-full border-b-2 px-1 sm:px-3 py-0.5 font-semibold border-red-700">

                                <p class="text-xs sm:text-[14px]">

                                    {{ $variant->label }}
                                    @if ($variant->size)
                                        {{ $variant->size }}"
                                    @endif

                                </p>

                            </div>

                        @empty
                            <div class="w-full px-2 py-1">

                                <p class="text-xs text-center">
                                    No Size
                                </p>

                            </div>
                        @endforelse
                         @if ($product->variants->count())

                            <!-- Extra Bottom Divider -->
                            <div class="w-full font-semibold">
                                <p class="opacity-0 text-xxs">#</p>
                            </div>
                         @endif
                    </div>
                </div>
          
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
