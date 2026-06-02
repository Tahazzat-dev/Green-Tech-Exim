@extends('layouts.app')
@section('content')
@include("partials.header")
<div class="flex-1 w-full pt-5">
   <button class="mx-auto px-6 bg-primary-500 text-white block text-lg" >Preview</button>
    <div class="w-full relative">
        <img 
                    src="{{ Vite::asset('resources/images/trophy-bg.png') }}"
                    class="absolute top-0 left-0 min-h-40 w-full max-w-60"
                     alt="Trophy logo">
        
    </div>
</div>
@endsection
