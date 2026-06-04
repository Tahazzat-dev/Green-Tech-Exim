@extends('layouts.app')
@section('title', 'Trophies')
@section('content')
@include("partials.header")
<div class="container flex-1 flex flex-col  mx-auto full p-4 py-7 md:px-6 lg:p-8 xl:p-10">
    <!-- page title -->
   <div class="w-full flex justify-center">
    <h1 class="text-center font-semibold" >All Trophies</h1>
   </div>

   <!-- page content -->
    <div class="w-full pt-5 md:pt-7 gap-4 md:gap-5 grid grid-cols-2  sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 ">
         <!-- Trophy card -->
        <?php foreach (range(1, 8) as $index): ?>
        <div class="flex flex-col items-center gap-2 lg:gap-3 p-4 rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border">

            <div class="relative aspect-square w-full">
                <img
                src="{{ Vite::asset('resources/images/trophy-big.png') }}"
                alt={trophy.name}
                class="h-full w-full object-contain drop-shadow-lg"
                referrerPolicy="no-referrer"
                />
            </div>
            
            <div class="w-full pb-2 flex items-center justify-center gap-3">
                <div class="flex gap-2.5 text-center">
                    <div class="w-3 border relative">
                        <p class="leading-[100%] text-[13px] absolute bg-red-700 px-1 py-0.5 -rotate-90 -left-5.5 top-2.5 font-semibold text-white" >MODEL</p>
                    </div>
                    <div class="flex flex-col text-base text-red-700 font-bold">
                        <span class="leading-[110%]" >RYAL</span>
                        <span class="leading-[110%]" >GLORY</span>
                    </div>
                 </div>

                 <div class="w-fit max-w-20 border-l-2 border-red-700">
                    <div class="w-full border-b-2 px-3 py-0.5 font-semibold border-red-700">
                    <p class="text-[14px]" >A 28"</p>
                    </div>
                    <div class="w-full border-b-2 px-3 pt-1 py-0.5 font-semibold border-red-700">
                    <p class="text-[14px]" >B 25"</p>
                    </div>
                    <div class="w-full px-3 font-semibold">
                    <p  class="opacity-0" >#</p>
                    </div>
                </div>
            </div>
          
            <div class="flex font-semibold gap-5 items-center" >
                <div>
                    <span class="text-lg" >Price:</span>
                </div> 
                <div class="grow flex flex-col">
                    <span class="text-md" >
                        A 6880 tk,
                    </span>
                    <span class="text-md" >
                        B 5700 tk
                    </span>
                </div>
            </div>
            <span class="inline-block text-primary bg-primary/20 font-semibold py-2 px-5 rounded-sm">In Stock</span>
        </div>
        <?php endforeach; ?>
        <!-- Trophy card -->
    </div>
</div>
@endsection
