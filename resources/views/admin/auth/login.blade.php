<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorized Admin Entry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center p-6">

<div class="w-full max-w-md bg-gray-900 border border-gray-800 p-8 rounded-2xl shadow-xl">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold tracking-tight text-white">Console Login</h2>
        <p class="text-sm text-gray-400 mt-1">Admin verification dashboard access portal</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-rose-950/50 border border-rose-800 text-rose-300 text-xs rounded-xl">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Phone Number</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2.5 bg-gray-950 border border-gray-800 rounded-xl text-sm text-white focus:outline-none focus:border-amber-500 transition">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Administrative PIN</label>
            <input type="password" name="pin" required class="w-full px-4 py-2.5 bg-gray-950 border border-gray-800 rounded-xl text-sm text-white tracking-widest focus:outline-none focus:border-amber-500 transition">
        </div>

        <button type="submit" class="w-full mt-2 py-3 px-4 bg-amber-500 text-gray-950 font-bold text-sm rounded-xl hover:bg-amber-400 transition-all duration-200 shadow-md">
            Verify & Authenticate
        </button>
    </form>
</div>

</body>
</html>