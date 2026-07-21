@extends('layouts.app')
@section('content')
@if (session('pending_account_popup'))
    <div
        x-data="{ open: true }"
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="pending-account-title"
    >
        <div
            x-show="open"
            x-transition.scale.origin.center
            @click.outside="open = false"
            class="w-full max-w-[420px] rounded-lg bg-background p-5 shadow-lg"
        >
            <div class="mb-4 flex items-start gap-3">
                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-secondary text-white">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" aria-hidden="true">
                        <path d="M320 64C178.6 64 64 178.6 64 320s114.6 256 256 256 256-114.6 256-256S461.4 64 320 64zm24 376c0 13.3-10.7 24-24 24s-24-10.7-24-24V304c0-13.3 10.7-24 24-24s24 10.7 24 24v136zm-24-208c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z" fill="currentColor" />
                    </svg>
                </div>
                <div>
                    <h2 id="pending-account-title" class="text-lg font-bold">Account Pending Approval</h2>
                    <p class="mt-2 text-sm">
                        Your registration has been submitted successfully. Please wait for admin approval before signing in.
                    </p>
                </div>
            </div>

            <button
                type="button"
                @click="open = false"
                class="btn-primary w-full py-3 text-base font-semibold"
            >
                OK
            </button>
        </div>
    </div>
@endif

<div class="flex items-center justify-center w-full min-h-screen h-full p-4 mx-auto" >
    <div class="w-full max-w-[500px] shadow-lg bg-background rounded-2xl p-4 md:p-5 lg:py-8 xl:py-10" >
        @if($errors->has('phone') && str_contains($errors->first('phone'), 'admin login'))
            <div class="mb-5 rounded-lg border border-secondary/20 bg-bg-body px-4 py-3 text-sm">
                <a href="{{ route('admin.signin') }}" class="underline link-text font-semibold">
                    Go to admin login
                </a>
            </div>
        @endif

        <div class="mb-8">
            <h4 class="text-base">Welcome Back</h4>
            <h1 class="font-bold mt-2">Please Sign In</h1>
        </div>
            <form autocomplete="off"  method="POST" action="{{ route('signin.submit') }}" class="space-y-5">
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
                        class="shrink-0 bg-secondary dark:bg-secondary-500 rounded-lg flex items-center px-2 lg:px-3"
                    >
                    <svg class="min-w-5 size-5 lg:size-6  text-primary text-lg"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M376 32C504.1 32 608 135.9 608 264C608 277.3 597.3 288 584 288C570.7 288 560 277.3 560 264C560 162.4 477.6 80 376 80C362.7 80 352 69.3 352 56C352 42.7 362.7 32 376 32zM384 224C401.7 224 416 238.3 416 256C416 273.7 401.7 288 384 288C366.3 288 352 273.7 352 256C352 238.3 366.3 224 384 224zM352 152C352 138.7 362.7 128 376 128C451.1 128 512 188.9 512 264C512 277.3 501.3 288 488 288C474.7 288 464 277.3 464 264C464 215.4 424.6 176 376 176C362.7 176 352 165.3 352 152zM176.1 65.4C195.8 60 216.4 70.1 224.2 88.9L264.7 186.2C271.6 202.7 266.8 221.8 252.9 233.2L208.8 269.3C241.3 340.9 297.8 399.3 368.1 434.2L406.7 387C418 373.1 437.1 368.4 453.7 375.2L551 415.8C569.8 423.6 579.9 444.2 574.5 463.9L573 469.4C555.4 534.1 492.9 589.3 416.6 573.2C241.6 536.1 103.9 398.4 66.8 223.4C50.7 147.1 105.9 84.6 170.5 66.9L176 65.4z" fill="currentColor" /></svg>
                       </label>
                        <input
                        id="phone"
                        type="number"
                        name="phone"
                        autocomplete="off"
                        value="{{ old('phone') }}"
                        placeholder="Enter your phone"
                        class=" text-text-body outline-0 py-2 px-4  border-0 grow"
                    >
                    </div>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Pin -->
                <div x-data="{show:false}" class="w-full" >
                    <div class="relative flex rounded-lg overflow-hidden bg-bg-body">
                         <label
                        for="pin"
                        class="shrink-0 bg-secondary dark:bg-secondary-500 rounded-lg flex items-center px-2 lg:px-3"
                    >
                    <svg class="min-w-5 size-5 lg:size-6  text-primary text-lg"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z" fill="currentColor" /></svg>
                       </label>
                        <input
                        id="pin"
                        :type="show ? 'text' : 'password'"
                        name="pin"
                        value="{{ old('pin') }}"
                        placeholder="Enter your pin"
                        autocomplete="off"
                        class="text-text-body outline-0 py-2 px-4  border-0 grow"
                    >
                    <button @click="show=!show" class="size-6 absolute top-1/2 right-4 -translate-y-1/2" type="button">
                        <svg class="dark:text-white" x-show="show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M320 96C239.2 96 174.5 132.8 127.4 176.6C80.6 220.1 49.3 272 34.4 307.7C31.1 315.6 31.1 324.4 34.4 332.3C49.3 368 80.6 420 127.4 463.4C174.5 507.1 239.2 544 320 544C400.8 544 465.5 507.2 512.6 463.4C559.4 419.9 590.7 368 605.6 332.3C608.9 324.4 608.9 315.6 605.6 307.7C590.7 272 559.4 220 512.6 176.6C465.5 132.9 400.8 96 320 96zM176 320C176 240.5 240.5 176 320 176C399.5 176 464 240.5 464 320C464 399.5 399.5 464 320 464C240.5 464 176 399.5 176 320zM320 256C320 291.3 291.3 320 256 320C244.5 320 233.7 317 224.3 311.6C223.3 322.5 224.2 333.7 227.2 344.8C240.9 396 293.6 426.4 344.8 412.7C396 399 426.4 346.3 412.7 295.1C400.5 249.4 357.2 220.3 311.6 224.3C316.9 233.6 320 244.4 320 256z" fill="currentColor" /></svg>
                        <svg class="dark:text-white" x-show="!show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M73 39.1C63.6 29.7 48.4 29.7 39.1 39.1C29.8 48.5 29.7 63.7 39 73.1L567 601.1C576.4 610.5 591.6 610.5 600.9 601.1C610.2 591.7 610.3 576.5 600.9 567.2L504.5 470.8C507.2 468.4 509.9 466 512.5 463.6C559.3 420.1 590.6 368.2 605.5 332.5C608.8 324.6 608.8 315.8 605.5 307.9C590.6 272.2 559.3 220.2 512.5 176.8C465.4 133.1 400.7 96.2 319.9 96.2C263.1 96.2 214.3 114.4 173.9 140.4L73 39.1zM236.5 202.7C260 185.9 288.9 176 320 176C399.5 176 464 240.5 464 320C464 351.1 454.1 379.9 437.3 403.5L402.6 368.8C415.3 347.4 419.6 321.1 412.7 295.1C399 243.9 346.3 213.5 295.1 227.2C286.5 229.5 278.4 232.9 271.1 237.2L236.4 202.5zM357.3 459.1C345.4 462.3 332.9 464 320 464C240.5 464 176 399.5 176 320C176 307.1 177.7 294.6 180.9 282.7L101.4 203.2C68.8 240 46.4 279 34.5 307.7C31.2 315.6 31.2 324.4 34.5 332.3C49.4 368 80.7 420 127.5 463.4C174.6 507.1 239.3 544 320.1 544C357.4 544 391.3 536.1 421.6 523.4L357.4 459.2z" fill="currentColor" /></svg>
                    </button>
                    </div>
                    @error('pin')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <button
                    type="submit"
                    class="btn-primary w-full text-base font-semibold click-effect py-3 rounded-lg"
                >
                    Sign In
                </button>

                <div class="space-y-2 text-center">
                    <p>Don't have an account? <a class="ml-1 underline link-text" href="{{ route('signup') }}" >Sign Up</a></p>
                    <a class="inline-block underline link-text" href="{{ route('home') }}">
                        Continue as guest
                    </a>
                    <p>
                        <a class="underline link-text" href="{{ route('admin.signin') }}">
                            Admin login
                        </a>
                    </p>
                </div>
            </form>
    </div>
    
</div>
@endsection
