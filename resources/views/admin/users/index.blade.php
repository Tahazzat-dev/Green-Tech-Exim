@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('partials.header')

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <!-- page title -->
    <div class="w-full flex items-center justify-between">

        <h1 class="font-semibold">
            Users
        </h1>

        <a
            href="{{ route('admin.users.create') }}"
            class="btn-primary px-4 py-2 rounded-lg"
        >
            Add User
        </a>

    </div>

    <!-- table -->
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

                        <td class="p-4">

                            <img
                                src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://placehold.co/60x60' }}"
                                class="size-12 rounded-full object-cover"
                            >

                        </td>

                        <td class="p-4">
                            {{ $user->name }}
                        </td>

                        <td class="p-4">
                            {{ $user->phone }}
                        </td>

                        <td class="p-4">
                            {{ $user->shop_name }}
                        </td>

                        <td class="p-4 pl-9">
                            {{ $user->discount ?? 0 }}%
                        </td>

                        <td class="p-4">
                            {{ ucfirst($user->status) }}
                        </td>

                        <td class="p-4">
                            {{ ucfirst($user->role) }}
                        </td>

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

                        <td colspan="7" class="p-8 text-center">
                            No users found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>

@endsection