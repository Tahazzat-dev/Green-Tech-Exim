@extends('layouts.app')

@section('title', 'Settings')

@section('content')

@include('partials.header')

<div class="custom-container max-w-4xl mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10 space-y-6">
    <div
        x-data="{ disableTwoFactorOpen: {{ $errors->has('disable_two_factor_code') ? 'true' : 'false' }} }"
        class="space-y-6"
    >
    <div class="bg-background border border-border rounded-xl p-5 space-y-5">
        <div>
            <h2 class="font-semibold">
                Two-Factor Authentication
            </h2>
            <p class="mt-2 text-sm">
                Protect admin login with a code from Google Authenticator or a similar app.
            </p>
        </div>

        @if(session('two_factor_success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('two_factor_success') }}
            </div>
        @endif

        @if(session('two_factor_error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('two_factor_error') }}
            </div>
        @endif

        <div class="flex items-center justify-between gap-4 rounded-lg border border-border bg-bg-body px-4 py-3">
            <div>
                <p class="font-medium">Status</p>
                <p class="text-sm mt-1">
                    @if($user->hasTwoFactorEnabled())
                        Two-factor authentication is enabled for your admin account.
                    @else
                        Two-factor authentication is currently disabled.
                    @endif
                </p>
            </div>
            <span class="rounded-full px-3 py-1 text-sm font-semibold {{ $user->hasTwoFactorEnabled() ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-700' }}">
                {{ $user->hasTwoFactorEnabled() ? 'Enabled' : 'Disabled' }}
            </span>
        </div>

        @if($twoFactorSetupActive && $twoFactorQrSvg)
            <div class="rounded-lg border border-border bg-bg-body p-5 space-y-4">
                <div>
                    <h3 class="font-semibold">Scan QR Code</h3>
                    <p class="text-sm mt-2">
                        Open Google Authenticator, tap add account, then scan this QR code with your phone.
                    </p>
                </div>

                <div class="flex justify-center rounded-lg bg-white p-4">
                    {!! $twoFactorQrSvg !!}
                </div>

                <form method="POST" action="{{ route('admin.settings.two-factor.confirm') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="two_factor_code" class="block mb-2">
                            Enter code from authenticator app
                        </label>
                        <input
                            id="two_factor_code"
                            type="text"
                            name="code"
                            inputmode="numeric"
                            maxlength="6"
                            placeholder="000000"
                            class="w-full rounded-lg border border-border bg-background px-4 py-3 tracking-[0.25em]"
                        >
                        @error('two_factor_code')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit" class="btn-primary px-6 py-3 rounded-lg">
                            Confirm and Enable
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('admin.settings.two-factor.cancel') }}">
                    @csrf
                    <button
                        type="submit"
                        class="rounded-lg border border-border px-6 py-3 font-semibold"
                    >
                        Cancel Setup
                    </button>
                </form>
            </div>
        @elseif(! $user->hasTwoFactorEnabled())
            <form method="POST" action="{{ route('admin.settings.two-factor.enable') }}">
                @csrf
                <button type="submit" class="btn-primary px-6 py-3 rounded-lg">
                    Enable Two-Factor Authentication
                </button>
            </form>
        @else
            <button
                type="button"
                @click="disableTwoFactorOpen = true"
                class="rounded-lg bg-red-600 px-6 py-3 font-semibold text-white"
            >
                Disable Two-Factor Authentication
            </button>
        @endif

        <div
            x-show="disableTwoFactorOpen"
            x-transition.opacity
            class="fixed inset-0 z-[60] flex items-center justify-center bg-black/50 px-4"
            role="dialog"
            aria-modal="true"
            style="display: none;"
        >
            <div
                x-show="disableTwoFactorOpen"
                x-transition.scale.origin.center
                @click.outside="disableTwoFactorOpen = false"
                class="w-full max-w-[420px] rounded-lg bg-background p-5 shadow-lg"
            >
                <h3 class="text-lg font-bold">Disable Two-Factor Authentication</h3>
                <p class="mt-2 text-sm">
                    Enter the current code from your authenticator app to disable two-factor authentication.
                </p>

                <form method="POST" action="{{ route('admin.settings.two-factor.disable') }}" class="mt-5 space-y-4">
                    @csrf
                    <input
                        type="text"
                        name="code"
                        inputmode="numeric"
                        maxlength="6"
                        placeholder="000000"
                        class="w-full rounded-lg border border-border bg-bg-body px-4 py-3 tracking-[0.25em]"
                    >
                    @error('disable_two_factor_code')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="flex gap-3">
                        <button
                            type="button"
                            @click="disableTwoFactorOpen = false"
                            class="w-full rounded-lg border border-border px-4 py-3 font-semibold"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="w-full rounded-lg bg-red-600 px-4 py-3 font-semibold text-white"
                        >
                            Disable
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form
        action="{{ route('admin.settings.update') }}"
        method="POST"
        class="bg-background border border-border rounded-xl p-5 space-y-5"
    >
        @csrf
        @method('PUT')

        <div>
            <h1 class="font-semibold">
                Settings
            </h1>
            <p class="mt-2 text-sm">
                Manage social links used by the user dashboard.
            </p>
        </div>

        @if(session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <label class="block mb-2">
                WhatsApp Phone Number
            </label>
            <input
                type="text"
                name="whatsapp_phone"
                value="{{ old('whatsapp_phone', $settings->whatsapp_phone) }}"
                placeholder="017XXXXXXXX or 88017XXXXXXXX"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >
            @error('whatsapp_phone')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-2">
                Facebook Page Link
            </label>
            <input
                type="url"
                name="facebook_page_url"
                value="{{ old('facebook_page_url', $settings->facebook_page_url) }}"
                placeholder="https://www.facebook.com/your-page"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >
            @error('facebook_page_url')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Save Settings
        </button>
    </form>

    <form
        action="{{ route('admin.settings.privacy-policy.update') }}"
        method="POST"
        class="bg-background border border-border rounded-xl p-5 space-y-5"
    >
        @csrf
        @method('PUT')

        <div>
            <h2 class="font-semibold">
                Privacy Policy
            </h2>
            <p class="mt-2 text-sm">
                Edit the content users will see on the privacy policy page.
            </p>
        </div>

        @if(session('privacy_success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('privacy_success') }}
            </div>
        @endif

        <div>
            <label class="block mb-2">
                Page Title
            </label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $privacyPolicy->title) }}"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >
            @error('title')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-2">
                Content
            </label>
            <textarea
                name="content"
                rows="16"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >{{ old('content', $privacyPolicy->content) }}</textarea>
            @error('content')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Save Privacy Policy
        </button>
    </form>
    </div>
</div>

@endsection
