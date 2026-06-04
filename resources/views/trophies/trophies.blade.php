@extends('layouts.app')
@section('title', 'Trophies')
@section('content')
@include("partials.header")
<div class="custom-container flex-1 flex flex-col  mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">
    <!-- page title -->
   <div class="w-full flex justify-center">
    <h1 class="text-center font-semibold" >All Trophies</h1>
   </div>

   <!-- page content -->
    <div class="w-full pt-5 md:pt-7 gap-4 md:gap-5 grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))]">
         <!-- Trophy card -->
        <?php foreach (range(1, 8) as $index): ?>
        <div class="flex flex-col items-center gap-2 lg:gap-3 p-3 sm:p-4 rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border">

            <div class="relative aspect-square w-full">
                <img
                src="{{ Vite::asset('resources/images/trophy-big.png') }}"
                alt={trophy.name}
                class="h-full w-full object-contain drop-shadow-lg"
                referrerPolicy="no-referrer"
                />
            </div>
            
            <div class="w-full flex items-center justify-center gap-3">
                <div class="flex gap-2.5 text-center">
                    <div class="w-3 relative">
                        <p class="leading-[100%] text-xs sm:text-[13px] absolute bg-red-700 px-1 pt-0.5 -rotate-90 -left-5.5 top-2.5 font-semibold text-white" >MODEL</p>
                    </div>
                    <div class="flex flex-col text-sm sm:text-base text-red-700 font-bold">
                        <span class="leading-[110%]" >RYAL</span>
                        <span class="leading-[110%]" >GLORY</span>
                    </div>
                 </div>

                 <div class="w-fit max-w-20 border-l-2 border-red-700">
                    <div class="w-full border-b-2 px-1 sm:px-3 py-0.5 font-semibold border-red-700">
                    <p class="text-xs sm:text-[14px]" >A 28"</p>
                    </div>
                    <div class="w-full border-b-2 px-1 sm:px-3 pt-1 py-0.5 font-semibold border-red-700">
                    <p class="text-xs sm:text-[14px]" >B 25"</p>
                    </div>
                    <div class="w-full font-semibold">
                    <p  class="opacity-0 text-xxs" >#</p>
                    </div>
                </div>
            </div>
          
            <div class="flex mb-1 font-semibold gap-5 items-center" >
                <h5 class="text-base sm:text-md text-center" ><span class="sm:hidden" >Price:</span> A 6880 Tk,  B 5700 Tk </h5>
            </div>
            <span class="text-sm sm:text-base inline-block text-primary bg-primary/20 font-semibold py-1 px-3 md:py-2 md:px-5 rounded-sm">In Stock</span>
        </div>
        <?php endforeach; ?>
        <!-- Trophy card -->
    </div>
</div>
@endsection
