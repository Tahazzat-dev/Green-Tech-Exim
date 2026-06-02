@extends('layouts.app')
@section('content')
@include("partials.header")
  <div class="container flex-1 flex flex-col max-w-5xl mt-5 lg:mt-10 xl:mt-20 w-full mx-auto">
      <button
        class="link-text"
      >
        <svg  class="min-w-5 size-5 lg:size-6 lg:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z"/></svg>
      </button>


       <div class="inline-block w-fit mx-auto mb-5 h-auto rounded-full bg-primary px-10 py-2 font-bold text-white shadow-sm">
                Preview
        </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start bg-white rounded-3xl p-5 md:p-8 shadow-md dark:bg-slate-900 border border-slate-100 dark:border-slate-800">
        <div class="lg:col-span-5 flex flex-col items-center">
          <div class="relative aspect-square w-full rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100/40 p-6 flex items-center justify-center border border-slate-50 dark:from-slate-950 dark:to-slate-950/60 dark:border-slate-800">
            <img
               src="{{ Vite::asset('resources/images/trophy-big.png') }}"
              alt={trophy.name}
              class="h-full w-full object-contain drop-shadow-lg"
              referrerPolicy="no-referrer"
            />
          </div>
        </div>

        <div class="lg:col-span-7 space-y-6">
          <div class="w-full flex items-center gap-1">
             <div class="w-1/2">
                 <div class="w-5 bg-red-500">
                      <h5 class="text-white" >MODEL</h5>
                 </div>
                 <div class="grow text-4xl text-red-500 font-bold">
                  <span>RYAL</span>
                 <span>GLORY</span>
                 </div>
             </div>

             <div class="w-1/2 border-l border-red-500">
                <div class="w-full border-b border-red-500">
                  <p>A 28"</p>
                </div>
                <div class="w-full border-b border-red-500">
                  <p>B 25"</p>
                </div>
             </div>
          </div>

            <h1>Price: A 6880 tk, B 5700 tk</h1>
            <span class="inline-block bg-primary/30 py-2 px-5 rounded-sm">In Stock</span>

             <button
              onClick={handleChatWhatsApp}
              type="button"
              class="btn-primary w-full py-4 rounded-xl text-sm font-bold shadow-md flex items-center justify-center gap-2.5 click-effect cursor-pointer"
            >
              <MessageSquare class="h-5 w-5 fill-white stroke-none" />
              <span>Chat With Us</span>
            </button>
            <button
              class="btn-secondary w-full flex items-center justify-center gap-2.5 click-effect cursor-pointer"
            >
            <svg class="min-w-5 size-5 lg:size-6 text-lg" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M568.4 37.7C578.2 34.2 589 36.7 596.4 44C603.8 51.3 606.2 62.2 602.7 72L424.7 568.9C419.7 582.8 406.6 592 391.9 592C377.7 592 364.9 583.4 359.6 570.3L295.4 412.3C290.9 401.3 292.9 388.7 300.6 379.7L395.1 267.3C400.2 261.2 399.8 252.3 394.2 246.7C388.6 241.1 379.6 240.7 373.6 245.8L261.2 340.1C252.1 347.7 239.6 349.7 228.6 345.3L70.1 280.8C57 275.5 48.4 262.7 48.4 248.5C48.4 233.8 57.6 220.7 71.5 215.7L568.4 37.7z"/></svg>
              <span>Send Product Details</span>
            </button>
        </div>

      </div>
    </div>
@endsection
