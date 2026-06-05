@extends('layouts.app')

@section('title', 'Create User')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <div class="w-full flex justify-between items-center mb-6">

        <h1 class="font-semibold">
            Create User
        </h1>

        <a
            href="{{ route('admin.users.index') }}"
            class="px-4 py-2 rounded-lg border border-border"
        >
            Back
        </a>

    </div>

    <form
        action="{{ route('admin.users.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5 bg-background border border-border rounded-xl p-5"
    >

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <!-- Name -->
            <div>
                <label class="block mb-2">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 outline-none"
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block mb-2">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 outline-none"
                >

                @error('phone')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Shop -->
            <div>
                <label class="block mb-2">
                    Shop Name
                </label>

                <input
                    type="text"
                    name="shop_name"
                    value="{{ old('shop_name') }}"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 outline-none"
                >
            </div>

            <!-- City -->
            <div>
                <label class="block mb-2">
                    City / Area
                </label>

                <input
                    type="text"
                    name="city_area"
                    value="{{ old('city_area') }}"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 outline-none"
                >
            </div>

            <!-- Role -->
            <div>
                <label class="block mb-2">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 outline-none"
                >
                    <option value="user">
                        User
                    </option>

                    <option value="admin">
                        Admin
                    </option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 outline-none"
                >
                    <option value="pending">
                        Pending
                    </option>

                    <option value="approved">
                        Approved
                    </option>

                    <option value="blocked">
                        Blocked
                    </option>

                    <option value="rejected">
                        Rejected
                    </option>
                </select>
            </div>

            <!-- PIN -->
            <div>
                <label class="block mb-2">
                    PIN
                </label>

                <input
                    type="password"
                    name="pin"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 outline-none"
                >
            </div>

            <!-- Confirm PIN -->
            <div>
                <label class="block mb-2">
                    Confirm PIN
                </label>

                <input
                    type="password"
                    name="pin_confirmation"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 outline-none"
                >
            </div>

            <!-- Photo -->
            <div class="md:col-span-2">
                <label class="block mb-2">
                    Photo
                </label>

                <input
                    type="file"
                    name="photo"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Create User
        </button>

    </form>

</div>

@endsection