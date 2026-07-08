@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">
<!-- Header -->
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
     <div class="flex justify-between  sm:justify-start items-center">
        <h1 class="font-semibold">
        Users
    </h1>
    <a
            href="{{ route('admin.users.create') }}"
            class="sm:hidden btn-primary px-4 py-2 rounded-lg whitespace-nowrap text-center"
        >
            Add User
        </a>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

        <!-- Search Form -->
        <form
            action="{{ route('admin.users.index') }}"
             method="GET"
            class="flex items-center w-full pr-1.5 md:w-[420px] rounded-lg overflow-hidden border border-border bg-bg-body"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search name, phone, shop or status..."
                 class="w-full bg-transparent px-4 py-1.5 outline-none text-text-body"
            >
            <button
                type="submit"
                class="rounded-full btn btn-primary p-1 shrink-0"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35M16 10.5A5.5 5.5 0 1 1 5 10.5a5.5 5.5 0 0 1 11 0Z"
                    />
                </svg>
            </button>

        </form>

        <!-- Add User -->
        <a
            href="{{ route('admin.users.create') }}"
            class="btn-primary px-4 py-2 rounded-lg whitespace-nowrap text-center"
        >
            Add User
        </a>

    </div>

</div>

<!-- Search Result -->
@if(request('search'))

    <div class="mt-4">

        <p class="text-sm text-text-body">

            Search result for:

            <span class="font-semibold">
                "{{ request('search') }}"
            </span>

        </p>

    </div>

@endif

<!-- Table -->
<div class="mt-6 overflow-y-hidden rounded-xl border border-border bg-background">

    <table class="w-full min-w-[900px]">

        <thead class="bg-bg-body">

            <tr>

                <th class="p-4 text-left">
                    Photo
                </th>

                <th class="p-4 text-left">
                    Name
                </th>

                <th class="p-4 text-left">
                    Phone
                </th>

                <th class="p-4 text-left">
                    PIN
                </th>

                <th class="p-4 text-left">
                    Shop
                </th>

                <th class="p-4 text-left">
                    Discount
                </th>

                <th class="p-4 text-left">
                    Status
                </th>

                <th class="p-4 text-left">
                    Role
                </th>

                <th class="p-4 text-right">
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($users as $user)

                <tr class="border-t border-border">

                    <!-- Photo -->
                    <td class="p-4">

                        <img
                            src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://placehold.co/60x60' }}"
                            class="size-12 rounded-full object-cover"
                            alt="{{ $user->name }}"
                        >

                    </td>

                    <!-- Name -->
                    <td class="p-4">
                        {{ $user->name }}
                    </td>

                    <!-- Phone -->
                    <td class="p-4">
                        {{ $user->phone }}
                    </td>

                    <!-- PIN -->
                    <td class="p-4 font-semibold">
                        {{ $user->plain_pin ?? 'Reset needed' }}
                    </td>

                    <!-- Shop -->
                    <td class="p-4">
                        {{ $user->shop_name }}
                    </td>

                    <!-- Discount -->
                    <td class="p-4 pl-9">
                        {{ $user->discount ?? 0 }}%
                    </td>

                    <!-- Status -->
                    <td class="p-4">

                        <span class="
                            px-2 py-1 rounded text-xs font-medium
                            {{
                                $user->status === 'approved'
                                    ? 'bg-green-500 text-white'
                                    : (
                                        $user->status === 'pending'
                                            ? 'bg-yellow-500 text-white'
                                            : 'bg-red-500 text-white'
                                    )
                            }}
                        ">

                            {{ ucfirst($user->status) }}

                        </span>

                    </td>

                    <!-- Role -->
                    <td class="p-4">

                        <span class="
                            px-2 py-1 rounded text-xs font-medium
                            {{
                                $user->role === 'admin'
                                    ? 'bg-purple-500 text-white'
                                    : 'bg-slate-500 text-white'
                            }}
                        ">

                            {{ ucfirst($user->role) }}

                        </span>

                    </td>

                    <!-- Actions -->
                    <td class="p-4">

                        <div class="flex justify-end gap-2">

                            <a
                                href="{{ route('admin.users.edit', $user) }}"
                                class="px-3 py-1 rounded bg-blue-500 text-white"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.users.destroy', $user) }}"
                                method="POST"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Delete user?')"
                                    class="px-3 py-1 rounded bg-red-500 text-white"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="p-8 text-center">

                        <div class="flex flex-col items-center gap-2">

                            <h3 class="font-semibold text-lg">
                                No users found
                            </h3>

                            @if(request('search'))

                                <p class="text-text-body">
                                    Try searching with another keyword.
                                </p>

                            @endif

                        </div>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<!-- Pagination -->
<div class="mt-6">

    {{ $users->withQueryString()->links() }}

</div>
</div>

@endsection
