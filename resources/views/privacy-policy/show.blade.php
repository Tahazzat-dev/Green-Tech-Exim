@extends('layouts.app')

@section('title', $privacyPolicy->title)

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10 h-full">
    <div class="w-full flex items-center">
        <button
            type="button"
            onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.href = '{{ route('categories.all') }}'; }"
            class="md:hidden"
        >
            <svg class="min-w-5 size-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" aria-hidden="true"><path d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z"/></svg>
        </button>
        <h1 class="text-center font-semibold flex-1 md:flex-none md:mx-auto">
            {{ $privacyPolicy->title }}
        </h1>
        <div class="md:hidden min-w-5 size-6"></div>
    </div>

    <div class="w-full pt-5 md:pt-7">
        <div class="space-y-4 text-text-body">
            {!! nl2br(e($privacyPolicy->content)) !!}
        </div>
    </div>
</div>

@endsection
