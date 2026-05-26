<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorized Entry | Control Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center p-4 sm:p-6 antialiased font-sans">

<div class="w-full max-w-md bg-gray-900 border border-gray-800 p-6 sm:p-8 rounded-2xl shadow-2xl relative overflow-hidden">
    
    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-400"></div>

    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-500 mb-3">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold tracking-tight text-white">Console Engine</h2>
        <p class="text-sm text-gray-400 mt-1">Admin verification dashboard access portal</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-950/40 border border-rose-800/60 text-rose-300 text-xs rounded-xl flex items-start gap-3">
            <svg class="w-4 h-4 shrink-0 mt-0.5 text-rose-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <div>
                <span class="font-semibold block mb-0.5">Authentication failed:</span>
                {{ $errors->first() }}
            </div>
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label for="phone" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Phone Number</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.423-5.15-3.746-6.57-6.57l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </span>
                <input 
                    type="text" 
                    id="phone"
                    name="phone" 
                    value="{{ old('phone') }}" 
                    required 
                    placeholder="Enter phone number"
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-950 border border-gray-800 rounded-xl text-sm text-white placeholder-gray-600 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all duration-200"
                >
            </div>
        </div>

        <div>
            <label for="pin" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Administrative PIN</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-500">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>
                </span>
                <input 
                    type="password" 
                    id="pin"
                    name="pin" 
                    required 
                    placeholder="••••••"
                    maxlength="6"
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-950 border border-gray-800 rounded-xl text-sm text-white placeholder-gray-600 tracking-widest focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all duration-200"
                >
            </div>
        </div>

        <button 
            type="submit" 
            class="w-full mt-2 py-3 px-4 bg-amber-500 text-gray-950 font-bold text-sm rounded-xl hover:bg-amber-400 active:scale-[0.99] transition-all duration-200 shadow-lg shadow-amber-500/10 flex items-center justify-center gap-2"
        >
            Verify & Authenticate
        </button>
    </form>
</div>

</body>
</html>