@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <div class="w-full flex justify-between items-center mb-6">

        <h1 class="font-semibold">
            Edit User
        </h1>

        <a
            href="{{ route('admin.users.index') }}"
            class="px-4 py-2 rounded-lg border border-border"
        >
            Back
        </a>

    </div>

    <form
        action="{{ route('admin.users.update', $user) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5 bg-background border border-border rounded-xl p-5"
    >

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label class="block mb-2">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
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
                    value="{{ old('phone', $user->phone) }}"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div>
                <label class="block mb-2">
                    Shop Name
                </label>

                <input
                    type="text"
                    name="shop_name"
                    value="{{ old('shop_name', $user->shop_name) }}"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

               <div>
                <label class="block mb-2">
                    Photo
                </label>

                <input
                    type="file"
                    name="photo"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div>
                <label class="block mb-2">
                    City / Area
                </label>

                <input
                    type="text"
                    name="city_area"
                    value="{{ old('city_area', $user->city_area) }}"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <!-- <div>
                <label class="block mb-2">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
                    <option
                        value="user"
                        @selected($user->role === 'user')
                    >
                        User
                    </option>

                    <option
                        value="admin"
                        @selected($user->role === 'admin')
                    >
                        Admin
                    </option>
                </select>
            </div> -->

             <div>
                <label class="block mb-2">
                    Discount %
                </label>

                <input
                    type="number"
                    name="discount"
                    value="{{ old('discount', $user->discount) }}"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div>
                <label class="block mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
                    <option value="pending" @selected($user->status === 'pending')>
                        Pending
                    </option>

                    <option value="approved" @selected($user->status === 'approved')>
                        Approved
                    </option>

                    <option value="blocked" @selected($user->status === 'blocked')>
                        Blocked
                    </option>

                    <option value="rejected" @selected($user->status === 'rejected')>
                        Rejected
                    </option>
                </select>
            </div>

            <div>
                <label class="block mb-2">
                    New PIN
                    @if ($user->plain_pin)
                        <span class="text-sm text-text-body">(current: {{ $user->plain_pin }})</span>
                    @endif
                </label>

                <input
                    type="text"
                    name="pin"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div class="md:col-span-2 rounded-lg border border-border bg-bg-body p-4">
                <label class="flex items-start gap-3">
                    <input
                        type="checkbox"
                        name="device_change_allowed"
                        value="1"
                        @checked(old('device_change_allowed', $user->device_change_allowed))
                        class="mt-1"
                    >
                    <span>
                        <span class="block font-semibold">
                            Allow new device login
                        </span>
                        <span class="block text-sm text-text-body">
                            The next correct mobile login will replace the current device and disable this permission.
                        </span>
                    </span>
                </label>
            </div>
        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Update User
        </button>

    </form>

</div>

@endsection
