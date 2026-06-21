@extends('layouts.app')

@section('title', 'Category Details')

@section('content')

@include('partials.header')

<div class="custom-container max-w-3xl mx-auto p-4 py-7">

    <div class="bg-background border border-border rounded-xl p-6">

        <img
            src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/trophy-big.png') }}"
            class="w-full max-h-96 object-contain rounded-xl bg-bg-body p-5"
        >

        <div class="mt-6">

            <h1 class="font-bold text-2xl">
                {{ $category->name }}
            </h1>

            <p class="mt-2 text-sm text-text-body">
                Slug:
                {{ $category->slug }}
            </p>

            <p class="mt-2 text-sm text-text-body">
                Total Products:
                {{ $category->products()->count() }}
            </p>

        </div>

        <div class="flex gap-3 mt-6">

            <a
                href="{{ route('admin.categories.edit', $category) }}"
                class="px-4 py-2 rounded-lg bg-blue-500 text-white"
            >
                Edit
            </a>

            <a
                href="{{ route('admin.categories.index') }}"
                class="px-4 py-2 rounded-lg border border-border"
            >
                Back
            </a>

        </div>

    </div>

</div>

@endsection