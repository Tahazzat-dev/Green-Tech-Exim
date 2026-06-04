@extends('layouts.app')
@section('title', 'Categories')
@section('content')
@include("partials.header")
<div class="custom-container flex-1 flex flex-col  mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">
    <!-- page title -->
   <div class="w-full flex justify-center">
    <h1 class="text-center font-semibold" >Categories</h1>
   </div>

   <!-- page content -->
    <div class="w-full pt-5 md:pt-7 gap-4 md:gap-5 grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))]">
         <!-- Trophy card -->
        <?php foreach (range(1, 8) as $index): ?>
        <div class="flex flex-col items-center rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border">
            <div class="relative rounded-b-xl bg-slate-200 dark:bg-slate-800 p-3 sm:p-4 aspect-square w-full">
                <img
                src="{{ Vite::asset('resources/images/trophy-big.png') }}"
                alt={trophy.name}
                class="h-full w-full object-contain drop-shadow-lg"
                referrerPolicy="no-referrer"
                />
            </div>
            
            <div class="p-1 py-3 sm:py-4 w-full flex items-center justify-center gap-3">
                <h4 class="font-semibold">Plastic Trophy</h4>
            </div>  
        </div>
        <?php endforeach; ?>
        <!-- Trophy card -->
    </div>
</div>
@endsection
