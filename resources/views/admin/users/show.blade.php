@extends('layouts.app')

@section('title', 'User Details')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <div class="bg-background border border-border rounded-xl p-6 max-w-3xl mx-auto w-full">

        <div class="flex flex-col items-center text-center">

            <img
                src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://placehold.co/120x120' }}"
                class="size-28 rounded-full object-cover border border-border"
            >

            <h1 class="mt-5 font-bold text-xl">
                {{ $user->name }}
            </h1>

            <p class="text-sm text-text-body mt-1">
                {{ $user->phone }}
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-8">

            <div>
                <h4 class="font-medium mb-1">
                    Shop Name
                </h4>

                <p>
                    {{ $user->shop_name }}
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-1">
                    City / Area
                </h4>

                <p>
                    {{ $user->city_area }}
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-1">
                    Role
                </h4>

                <p>
                    {{ ucfirst($user->role) }}
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-1">
                    PIN
                </h4>

                <p>
                    {{ $user->plain_pin ?? 'Reset needed' }}
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-1">
                    Status
                </h4>

                <p>
                    {{ ucfirst($user->status) }}
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-1">
                    Device ID
                </h4>

                <p class="break-all">
                    {{ $user->device_id }}
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-1">
                    Registered At
                </h4>

                <p>
                    {{ $user->created_at->format('d M Y h:i A') }}
                </p>
            </div>

        </div>

        <div class="mt-8 flex gap-3">

            <a
                href="{{ route('admin.users.edit', $user) }}"
                class="px-5 py-3 rounded-lg bg-blue-500 text-white"
            >
                Edit
            </a>

            <a
                href="{{ route('admin.users.index') }}"
                class="px-5 py-3 rounded-lg border border-border"
            >
                Back
            </a>

        </div>

    </div>

</div>

@endsection
