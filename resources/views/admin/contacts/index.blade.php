@extends('layouts.app')

@section('title', 'Contacts')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <div class="flex items-center justify-between mb-6">

        <h1 class="font-semibold">
            Contacts
        </h1>

        <a
            href="{{ route('admin.contacts.create') }}"
            class="btn-primary px-4 py-2 rounded-lg"
        >
            Add Contact
        </a>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        @forelse($contacts as $contact)

            <div class="bg-background border border-border rounded-xl p-5">

                <div class="flex flex-col items-center text-center">

                    <img
                        src="{{ $contact->profile ? asset('storage/' . $contact->profile) : 'https://placehold.co/120x120' }}"
                        class="size-24 rounded-full object-cover border border-border"
                    >

                    <h3 class="font-semibold mt-4">
                        {{ $contact->name }}
                    </h3>

                    <p class="text-text-body text-sm mt-1">
                        {{ $contact->designation }}
                    </p>

                    <p class="mt-2">
                        {{ $contact->phone }}
                    </p>

                    <div class="mt-3">

                        <span class="px-3 py-1 rounded text-sm
                            {{ $contact->status
                                ? 'bg-green-500 text-white'
                                : 'bg-red-500 text-white'
                            }}"
                        >
                            {{ $contact->status ? 'Active' : 'Inactive' }}
                        </span>

                    </div>

                </div>

                <div class="flex gap-2 mt-5">

                    <a
                        href="{{ route('admin.contacts.show', $contact) }}"
                        class="flex-1 text-center px-3 py-2 rounded bg-slate-700 text-white text-sm"
                    >
                        View
                    </a>

                    <a
                        href="{{ route('admin.contacts.edit', $contact) }}"
                        class="flex-1 text-center px-3 py-2 rounded bg-blue-500 text-white text-sm"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('admin.contacts.destroy', $contact) }}"
                        method="POST"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Delete contact?')"
                            class="px-3 py-2 rounded bg-red-500 text-white text-sm"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="col-span-full text-center py-10">
                No contacts found.
            </div>

        @endforelse

    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>

</div>

@endsection