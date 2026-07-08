@extends('layouts.app')
@section('content')
@include("partials.header")
  <div class="container flex-1  lg:px-4 flex flex-col max-w-2xl lg:max-w-5xl pb-10 pt-0 lg:py-10 xl:py-20 w-full mx-auto">

     <div class="pt-5 lg:pt-0 w-full">
       <div class="w-full mb-5 flex px-4 items-center">
        <button
         class="md:hidden"
      >
        <svg  class="min-w-5 size-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z"/></svg>
      </button>
       <div class=" inline-block w-fit mx-auto text-md h-auto rounded-full bg-primary px-10 py-2 font-bold text-white shadow-sm">
                Preview
        </div>
      </div>
     </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start   md:bg-white rounded-3xl p-5 md:p-8 md:shadow-md md:dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
        <div class="lg:col-span-5 flex flex-col items-center">
          <div class="relative aspect-square w-full rounded-2xl md:bg-gradient-to-br from-slate-50 to-slate-100/40 md:p-6 flex items-center justify-center border border-slate-50 dark:from-slate-900/70 dark:to-slate-900 dark:border-slate-800">
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
        </div>

        <div class="text-center lg:text-left lg:col-span-7 space-y-3 md:space-y-6">
          <div class="w-full pb-2 flex items-center justify-center lg:justify-start gap-8 lg:gap-10">
             <div class="flex gap-5">
                 <div class="w-7 relative">
                      <h5 class="absolute bg-red-700 px-1 py-0.5 -rotate-90 -left-5.5 top-7 font-bold text-white" >MODEL</h5>
                 </div>
                 <div class="flex py-2 flex-col text-2xl text-red-700 font-bold">
                    @foreach (explode(' ', strtoupper($product->name)) as $part)
                        <span class="leading-[110%]" >{{ $part }}</span>
                    @endforeach
                 </div>
             </div>

             <div class="w-fit max-w-32 border-l-2 border-red-700">
                @forelse ($product->variants as $variant)
                    <div class="w-full border-b-2 py-1 px-6 lg:px-7 font-semibold border-red-700">
                        <p class="text-base" >
                            {{ $variant->label }}
                            @if ($variant->size)
                                {{ $variant->size }}"
                            @endif
                        </p>
                    </div>
                @empty
                    <div class="w-full border-b-2 py-1 px-6 lg:px-7 font-semibold border-red-700">
                        <p class="text-base" >No Size</p>
                    </div>
                @endforelse
                <div class="w-full py-1 px-5 font-semibold">
                  <p  class="opacity-0" >#</p>
                </div>
             </div>
          </div>

            @auth
                @php
                    $userDiscount = auth()->user()?->discount ?? 0;
                @endphp

                <h1 class="font-semibold" >
                    Price:
                    @forelse ($product->variants as $variant)
                        @php
                            $discountAmount = ($variant->amount * $userDiscount) / 100;
                            $finalPrice = $variant->amount - $discountAmount;
                        @endphp

                        {{ $variant->label }} {{ number_format($finalPrice) }} tk{{ $loop->last ? '' : ',' }}
                    @empty
                        No Price
                    @endforelse
                </h1>
            @endauth

            @guest
                <h1 class="font-semibold">
                    Login for price details.
                </h1>
            @endguest
            <span class="inline-block {{
                $product->status === 'in_stock'
                    ? 'text-primary bg-primary/20'
                    : 'text-red-600 bg-red-100 dark:bg-red-900/30'
            }} font-semibold py-2 px-5 rounded-sm">
                {{ $product->status === 'in_stock' ? 'In Stock' : 'Out of Stock' }}
            </span>
            <button
              class="mt-1 md:mt-0 btn-primary max-w-72 lg:max-w-auto mx-auto py-1.5 max-h-[52.41px] w-full flex items-center justify-center gap-2.5 click-effect cursor-pointer"
            >
            <svg class="min-w-5 size-8 lg:size-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z"/></svg>
              <span class="text-md font-semibold" >Chat With Us</span>
            </button>
        </div>

      </div>
    </div>
@endsection
