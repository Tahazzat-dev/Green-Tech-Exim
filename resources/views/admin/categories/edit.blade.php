@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

@include('partials.header')

<div class="custom-container max-w-3xl mx-auto p-4 py-7">

    <form
        action="{{ route('admin.categories.update', $category) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-background border border-border rounded-xl p-5 space-y-5"
    >

        @csrf
        @method('PUT')

        <h1 class="font-semibold">
            Edit Category
        </h1>

        <div>

            <label class="block mb-2">
                Category Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $category->name) }}"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        <div>

            <label class="block mb-2">
                Category Image
            </label>

            <input
                type="file"
                name="image"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        @if($category->image)

            <img
                src="{{ asset('storage/' . $category->image) }}"
                class="size-32 object-cover rounded-lg"
            >

        @endif

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Update Category
        </button>

    </form>

</div>

@endsection