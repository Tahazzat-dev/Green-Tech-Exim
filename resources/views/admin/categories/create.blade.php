@extends('layouts.app')

@section('title', 'Create Category')

@section('content')

@include('partials.header')

<div class="custom-container max-w-3xl mx-auto p-4 py-7">

    <form
        action="{{ route('admin.categories.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-background border border-border rounded-xl p-5 space-y-5"
    >

        @csrf

        <h1 class="font-semibold">
            Create Category
        </h1>

        <div>

            <label class="block mb-2">
                Category Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
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

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Create Category
        </button>

    </form>

</div>

@endsection