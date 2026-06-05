@extends('layouts.app')

@section('title', 'Edit Contact')

@section('content')

@include('partials.header')

<div class="custom-container max-w-3xl mx-auto p-4 py-7">

    <form
        action="{{ route('admin.contacts.update', $contact) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-background border border-border rounded-xl p-5 space-y-5"
    >

        @csrf
        @method('PUT')

        <h1 class="font-semibold">
            Edit Contact
        </h1>

        <input
            type="text"
            name="name"
            value="{{ old('name', $contact->name) }}"
            class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
        >

        <input
            type="text"
            name="designation"
            value="{{ old('designation', $contact->designation) }}"
            class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
        >

        <input
            type="text"
            name="phone"
            value="{{ old('phone', $contact->phone) }}"
            class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
        >

        <input
            type="file"
            name="profile"
            class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
        >

        @if($contact->profile)

            <img
                src="{{ asset('storage/' . $contact->profile) }}"
                class="size-28 rounded-full object-cover"
            >

        @endif

        <div class="flex items-center gap-3">

            <input
                type="checkbox"
                name="status"
                value="1"
                @checked($contact->status)
            >

            <label>
                Active
            </label>

        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Update Contact
        </button>

    </form>

</div>

@endsection