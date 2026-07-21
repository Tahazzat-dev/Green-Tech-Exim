@extends('layouts.app')

@section('title', 'Admin Verification')

@section('content')
<div class="flex items-center justify-center w-full min-h-screen h-full p-4 mx-auto">
    <div class="w-full max-w-[500px] shadow-lg bg-background rounded-2xl p-4 md:p-5 lg:py-8 xl:py-10">
        <div class="mb-6">
            <h4 class="text-base">Admin Verification</h4>
            <h1 class="font-bold mt-2">Enter Authenticator Code</h1>
            <p class="mt-3 text-sm">
                Open Google Authenticator or a similar app and enter the 6-digit code for this admin account.
            </p>
        </div>

        <form method="POST" action="{{ route('admin.2fa.verify') }}" class="space-y-5">
            @csrf

            <div>
                <div class="flex rounded-lg overflow-hidden bg-bg-body">
                    <label
                        for="code"
                        class="shrink-0 bg-secondary dark:bg-secondary-500 rounded-lg flex items-center px-2 lg:px-3"
                    >
                        <svg class="min-w-5 size-5 lg:size-6 text-primary text-lg" fill="currentColor" viewBox="0 0 640 640" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z"/></svg>
                    </label>
                    <input
                        id="code"
                        type="text"
                        name="code"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        maxlength="6"
                        placeholder="Enter 6-digit code"
                        class="text-text-body outline-0 py-2 px-4 border-0 grow tracking-[0.25em]"
                    >
                </div>
                @error('code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="btn-primary w-full text-base font-semibold click-effect py-3 rounded-lg"
            >
                Verify
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('admin.signin') }}" class="underline link-text">
                Back to admin login
            </a>
        </div>
    </div>
</div>
@endsection
