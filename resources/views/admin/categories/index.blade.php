@extends('layouts.app')

@section('title', 'Categories')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <!-- title -->
    <div class="flex items-center justify-between mb-6">

        <h1 class="font-semibold">
            Categories
        </h1>

        <a
            href="{{ route('admin.categories.create') }}"
            class="btn-primary px-4 py-2 rounded-lg"
        >
            Add Category
        </a>

    </div>

    <!-- categories -->
    <div class="grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))] gap-5">

        @forelse($categories as $category)

            <div class="rounded-xl border border-border bg-background overflow-hidden shadow-sm">

                <div class="aspect-square bg-bg-body p-4">

                    <img
                        src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/trophy-big.png') }}"
                        class="w-full h-full object-contain"
                    >

                </div>

                <div class="p-4">

                    <h3 class="font-semibold">
                        {{ $category->name }}
                    </h3>

                    <div class="flex gap-2 mt-4">

                        <a
                            href="{{ route('admin.categories.show', $category) }}"
                            class="px-3 py-2 rounded bg-slate-700 text-white text-sm"
                        >
                            View
                        </a>

                        <a
                            href="{{ route('admin.categories.edit', $category) }}"
                            class="px-3 py-2 rounded bg-blue-500 text-white text-sm"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.categories.destroy', $category) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete category?')"
                                class="px-3 py-2 rounded bg-red-500 text-white text-sm"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full text-center py-10">
                No categories found.
            </div>

        @endforelse

    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>

</div>

@endsection