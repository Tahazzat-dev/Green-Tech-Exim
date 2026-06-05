@extends('layouts.app')

@section('title', 'Create Contact')

@section('content')

@include('partials.header')

<div class="custom-container max-w-3xl mx-auto p-4 py-7">

    <form
        action="{{ route('admin.contacts.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-background border border-border rounded-xl p-5 space-y-5"
    >

        @csrf

        <h1 class="font-semibold">
            Create Contact
        </h1>

        <div>

            <label class="block mb-2">
                Name
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
                Designation
            </label>

            <input
                type="text"
                name="designation"
                value="{{ old('designation') }}"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        <div>

            <label class="block mb-2">
                Phone
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        <div>

            <label class="block mb-2">
                Profile Photo
            </label>

            <input
                type="file"
                name="profile"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        <div class="flex items-center gap-3">

            <input
                type="checkbox"
                name="status"
                value="1"
                checked
            >

            <label>
                Active
            </label>

        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Create Contact
        </button>

    </form>

</div>

@endsection