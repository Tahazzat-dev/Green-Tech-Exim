@extends('layouts.app')

@section('title', 'Contact Details')

@section('content')

@include('partials.header')

<div class="custom-container max-w-3xl mx-auto p-4 py-7">

    <div class="bg-background border border-border rounded-xl p-6">

        <div class="flex flex-col items-center text-center">

            <img
                src="{{ $contact->profile ? asset('storage/' . $contact->profile) : 'https://placehold.co/120x120' }}"
                class="size-32 rounded-full object-cover border border-border"
            >

            <h1 class="font-bold text-2xl mt-5">
                {{ $contact->name }}
            </h1>

            <p class="text-text-body mt-2">
                {{ $contact->designation }}
            </p>

        </div>

        <div class="mt-8 space-y-4">

            <div>

                <h4 class="font-medium">
                    Phone
                </h4>

                <p class="mt-1">
                    {{ $contact->phone }}
                </p>

            </div>

            <div>

                <h4 class="font-medium">
                    Status
                </h4>

                <p class="mt-1">
                    {{ $contact->status ? 'Active' : 'Inactive' }}
                </p>

            </div>

            <div>

                <h4 class="font-medium">
                    Created At
                </h4>

                <p class="mt-1">
                    {{ $contact->created_at->format('d M Y h:i A') }}
                </p>

            </div>

        </div>

        <div class="flex gap-3 mt-8">

            <a
                href="{{ route('admin.contacts.edit', $contact) }}"
                class="px-5 py-3 rounded-lg bg-blue-500 text-white"
            >
                Edit
            </a>

            <a
                href="{{ route('admin.contacts.index') }}"
                class="px-5 py-3 rounded-lg border border-border"
            >
                Back
            </a>

        </div>

    </div>

</div>

@endsection