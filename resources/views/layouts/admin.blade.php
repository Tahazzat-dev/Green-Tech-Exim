<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trophy Engine - Management Console</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">

<div class="flex min-h-screen">
    <aside class="w-64 bg-gray-900 text-gray-300 flex flex-col border-r border-gray-800 shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-gray-800">
            <span class="text-lg font-bold text-white flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                Trophy Portal
            </span>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                Users & Requests
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl hover:bg-gray-800 hover:text-white">
                Categories
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl hover:bg-gray-800 hover:text-white">
                Products
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl hover:bg-gray-800 hover:text-white">
                Contacts
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800 bg-gray-950/50">
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400 font-medium truncate">Admin Console</span>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs text-red-400 hover:underline">Sign Out</button>
                </form>
            </div>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

</body>
</html>