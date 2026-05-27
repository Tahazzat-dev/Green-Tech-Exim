@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center w-full h-full mx-auto" >
    <div class="w-full max-w-[500px] shadow-lg bg-background rounded-2xl p-4 md:p-5 lg:py-8 xl:py-10" >
        <div class="mb-8">
            <h4 class="text-base">Welcome Back</h4>
            <h1 class="font-bold mt-2">Please Sign In</h1>
        </div>
            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                @csrf

                <!-- @if ($errors->any())
                    <div class="rounded-lg bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif -->

                <!-- Phone -->
                <div class="w-full" >
                    <div class="flex rounded-lg overflow-hidden bg-bg-body">
                         <label
                        for="phone"
                        class="bg-slate-200 dark:bg-slate-800 rounded-lg flex items-center px-3"
                    >
                        <i class="fa-solid fa-phone-volume text-primary text-lg"></i>
                       </label>
                        <input
                        id="phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Enter your phone"
                        class="outline-0 py-2 px-2  border-0 grow"
                    >
                    </div>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="w-full" >
                    <div class="flex rounded-lg overflow-hidden bg-bg-body">
                         <label
                        for="phone"
                        class="rounded-lg flex items-center px-3"
                    >
                        <i class="fa-solid fa-phone-volume text-primary text-lg"></i>
                       </label>
                        <input
                        id="pin"
                        type="text"
                        name="pin"
                        value="{{ old('pin') }}"
                        placeholder="Enter your pin"
                        class="outline-0 py-2 px-2  border-0 grow"
                    >
                    </div>
                    @error('pin')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- PIN -->
                    <div>
                    <div class="flex rounded-lg overflow-hidden bg-bg-body">
                         <label
                        for="phone"
                        class="rounded-lg flex items-center px-3"
                    >
                        <i class="fa-solid fa-phone-volume text-primary text-lg"></i>
                    </label>
                        <input
                        id="phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Enter your phone"
                        class="outline-0 py-2 px-2  border-0 grow"
                    >
                    </div>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 transition text-white font-medium py-3 rounded-xl"
                >
                    Login
                </button>
            </form>
    </div>
</div>
@endsection
