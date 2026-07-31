 <!-- HEADER START -->
    <header class="sticky top-0 z-40 w-full border-b border-border bg-primary backdrop-blur-md">
        <div class="header-inner mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-14 lg:h-16 items-center justify-between">
                
                <!-- LEFT SIDE (Mobile: Hamburger Menu & Brand | Desktop: Brand) -->
                <div class="flex w-full lg:w-auto justify-between lg:justify-start items-center gap-4">
                    <!-- Hamburger button (Visible only on mobile/tablet < lg) -->
                    <button 
                        @click="mobileMenuOpen = true"
                        type="button" 
                        class="inline-flex items-center justify-center  lg:hidden"
                        aria-controls="mobile-drawer" 
                        :aria-expanded="mobileMenuOpen.toString()"
                    >
                        <svg class="size-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z" fill="currentColor" /></svg>
                    </button>

    @php

        $homeRoute = route('home');

        if (auth()->check()) {

            $homeRoute = auth()->user()->role === 'admin'
                ? route('admin.users.index')
                : route('categories.all');
        }

    @endphp

            <a
                href="{{ $homeRoute }}"
                class="flex items-center gap-2.5 shrink-0"
            >
                <div class="hidden lg:flex h-14 w-16 items-center justify-center">
                    <img
                        src="{{ asset('images/site-logo.png') }}"
                        alt="Site logo"
                    >
                </div>

                <span class="text-xl font-bold tracking-tight text-white lg:text-secondary">
                    Green Tech
                </span>
            </a>

                    <span></span>
                </div>

                <!-- DESKTOP NAVIGATION (Visible only on >= lg) -->

                <nav class="hidden lg:flex text-base lg:gap-10">
                    @guest
                        <a href="{{ route('categories.all') }}" class="nav-link text-base font-medium {{ request()->routeIs('home', 'categories.all') ? 'active' : '' }}">Categories</a>
                    @endguest
                  @auth
                     @if(auth()->user()->role === 'user')
                            <a href="{{ route('categories.all') }}" class="nav-link text-base font-medium {{ request()->routeIs('categories.all') ? 'active' : '' }}">Categories</a>
                            <a href="{{ route('executives') }}" class="nav-link text-base font-medium {{ request()->routeIs('executives') ? 'active' : '' }}">Contact Us</a>
                            @if($appSettings->facebook_page_url)
                                <a href="{{ $appSettings->facebook_page_url }}" target="_blank" rel="noopener noreferrer" class="nav-link text-base font-medium">Our Facebook Page</a>
                            @endif
                            <a href="{{ route('privacy-policy.show') }}" class="nav-link text-base font-medium {{ request()->routeIs('privacy-policy.show') ? 'active' : '' }}">Privacy Policy</a>
                            @if($appSettings->app_download_url)
                                <a href="{{ $appSettings->app_download_url }}" target="_blank" rel="noopener noreferrer"  class="flex flex-row  nav-link text-base font-medium">
                                    <div class="flex items-center gap-2">
                                        <span>Download App</span>
<svg fill="currentColor" height="22px" width="22px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 511.997 511.997" xml:space="preserve">
<g>
	<g>
		<g>
			<path d="M59.732,153.597c-23.526,0-42.667,19.14-42.667,42.667V315.73c0,23.526,19.14,42.667,42.667,42.667
				c23.526,0,42.667-19.14,42.667-42.667V196.264C102.399,172.737,83.258,153.597,59.732,153.597z"/>
			<path d="M452.265,153.597c-23.526,0-42.667,19.14-42.667,42.667V315.73c0,23.526,19.14,42.667,42.667,42.667
				s42.667-19.14,42.667-42.667V196.264C494.932,172.737,475.792,153.597,452.265,153.597z"/>
			<path d="M119.465,401.064h34.133v76.8c0,18.825,15.309,34.133,34.133,34.133s34.133-15.309,34.133-34.133v-76.8h68.267v76.8
				c0,18.825,15.309,34.133,34.133,34.133s34.133-15.309,34.133-34.133v-76.8h34.133V153.597H119.465V401.064z"/>
			<path d="M357.375,57.136c-5.726-5.82-12.894-11.998-21.623-17.715l13.244-27.153c2.074-4.233,0.316-9.344-3.925-11.409
				c-4.258-2.057-9.335-0.29-11.401,3.934l-12.8,26.232c-16.845-8.132-37.973-13.961-64.06-13.961
				c-25.967,0-47.71,5.393-65.843,13.926L178.345,4.818c-2.031-4.241-7.125-6.008-11.392-3.977
				c-4.241,2.048-6.025,7.151-3.968,11.401l12.996,26.957c-36.54,23.467-54.084,60.826-56.482,88.047l-0.819,9.284h274.637
				l-0.819-9.284C390.894,108.976,380.816,80.961,357.375,57.136z M213.332,102.397c-9.421,0-17.067-7.637-17.067-17.067
				c0-9.429,7.646-17.067,17.067-17.067c9.421,0,17.067,7.637,17.067,17.067C230.399,94.76,222.753,102.397,213.332,102.397z
				 M298.665,102.397c-9.421,0-17.067-7.637-17.067-17.067c0-9.429,7.646-17.067,17.067-17.067c9.421,0,17.067,7.637,17.067,17.067
				C315.732,94.76,308.086,102.397,298.665,102.397z"/>
		</g>
	</g>
</g>
</svg>
                                    </div>
                                </a>
                            @endif
                     @endif
                     @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.categories.index') }}" class="nav-link text-base font-medium {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">Categories</a>
                            <a href="{{ route('admin.products.index') }}" class="nav-link text-base font-medium {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">Products</a>
                            <a href="{{ route('admin.users.index') }}" class="nav-link text-base font-medium {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">Users</a>
                            <a href="{{ route('admin.contacts.index') }}" class="nav-link text-base font-medium {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">Contacts</a>
                            <a href="{{ route('admin.settings.edit') }}" class="nav-link text-base font-medium {{ request()->routeIs('admin.settings.edit') ? 'active' : '' }}">Settings</a>
                    @endif
                  @endauth
                    <button @click="theme = theme === 'dark' ? 'light' : 'dark'" class="text-base w-auto transition" >
                        <span x-show="theme=='dark'">🌙</span>
                        <span x-show="theme=='light'">☀️</span>
                    </button>
                </nav>

                @auth
                    <!-- logout form for both user and admins -->
                    <form method="POST" action="{{ route('logout') }}" id="desktop-logout-form" class="hidden">
                        @csrf
                    </form>
                    @if(auth()->user()->role === 'user')
                        <form method="POST" action="{{ route('account.destroy') }}" id="delete-account-form" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                @endauth

                <!-- DESKTOP RIGHT SIDE -->
                <div class="hidden lg:relative lg:block">
                    @auth
                        <!-- Authenticated User Profile Dropdown Toggle Button -->
                        <button 
                            @click="profileDropdownOpen = !profileDropdownOpen"
                            type="button" 
                            class="flex items-center rounded-full border border-border focus-within:border-ring"
                            aria-haspopup="true"
                            :aria-expanded="profileDropdownOpen.toString()"
                        >
                            <img 
                             src="{{ auth()->user()->photo
                                ? asset('storage/' . auth()->user()->photo)
                                : asset('images/user-placeholder.png') }}"
                                 alt="{{ auth()->user()->name }}"
                                class="h-9 w-9 rounded-full" 
                            >
                        </button>

                        <!-- Dropdown Menu -->

                            <div 
                                x-show="profileDropdownOpen"
                                @click.away="profileDropdownOpen = false"
                                @keydown.escape.window="profileDropdownOpen = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2.5 w-64 origin-top-right rounded-xl border border-border bg-background p-2 shadow-xl ring-1 ring-black/5 focus:outline-none"
                                style="display: none;"
                                role="menu" 
                                aria-orientation="vertical">
                                <!-- User Card Info Inside Dropdown -->
                                <div class="border-b  border-border px-3 py-3">
                                    <h5 class="mb-2 font-semibold" >{{auth()->user()->name}} </h5>
                                    <p class="text-base">{{auth()->user()->phone}}</p>
                                </div>
                                <!-- Authentication Form Submission (The secure Laravel Way) -->
                                <div class="border-t border-border pt-1">
                                    @if(auth()->user()->role === 'user')
                                        <button
                                            type="button"
                                            @click="profileDropdownOpen = false; deleteAccountModalOpen = true"
                                            class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50 transition-colors"
                                            role="menuitem"
                                        >
                                            <svg class="size-5" fill="currentColor" viewBox="0 0 640 640"><path d="M232.7 69.9L224 96L128 96C110.3 96 96 110.3 96 128C96 145.7 110.3 160 128 160L512 160C529.7 160 544 145.7 544 128C544 110.3 529.7 96 512 96L416 96L407.3 69.9C402.9 56.8 390.7 48 376.9 48L263.1 48C249.3 48 237.1 56.8 232.7 69.9zM512 208L128 208L149.1 531.1C150.8 556.4 171.8 576 197.2 576L442.8 576C468.2 576 489.2 556.4 490.9 531.1L512 208z"/></svg>
                                            Delete Account
                                        </button>
                                    @endif
                                    <a href="{{ route('logout') }}" 
                                    onclick="event.preventDefault(); document.getElementById('desktop-logout-form').submit();"
                                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors" 
                                    role="menuitem">
                                    <svg class="size-5" fill="currentColor" viewBox="0 0 640 640"><path d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"/></svg>
                                        Sign out
                                    </a>
                                </div>
                            </div>
                    @else
                        <a
                            href="{{ route('signin') }}"
                            class="btn-secondary px-4 py-2 rounded-lg font-semibold"
                        >
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile Header Right Accent Spacer -->
                <div class="flex lg:hidden items-center">
                    <button class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                        <i data-lucide="bell" class="h-5 w-5"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END -->

    <!-- Mobile header starts -->
    <div id="mobile-drawer" class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="mobileMenuOpen" x-cloak>
        
        <div 
            x-show="mobileMenuOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        ></div>

        <div class="fixed inset-0 flex">
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-translate:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                @click.away="mobileMenuOpen = false"
                class="relative flex w-full max-w-72 flex-col bg-white pb-6 shadow-2xl"
            >
                @auth
                    <div class="flex items-center justify-between gap-3 border-b border-slate-100 bg-secondary px-6 py-4">
                        <img 
                            class="h-14 w-14 rounded-full border-2 border-white object-cover" 
                            src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/user-placeholder.png') }}"
                            alt="{{ auth()->user()->name }}"
                            width="56" 
                            height="56"
                        >
                        <div class="grow min-w-0">
                            <h5 class="truncate text-xl font-semibold text-white">{{ auth()->user()->name }}</h5>
                            <p class="truncate font-semibold text-white/90 text-sm">{{ auth()->user()->phone }}</p>
                        </div>
                        <button @click="theme = theme === 'dark' ? 'light' : 'dark'" class="p-1 text-lg transition-transform active:scale-95" aria-label="Toggle theme">
                            <span x-show="theme === 'dark'">🌙</span>
                            <span x-show="theme === 'light'">☀️</span>
                        </button>
                    </div>

                    <div class="grow overflow-y-auto px-6 py-4">
                        <nav class="flex flex-col gap-2.5">
                            
                            @if(auth()->user()->role === 'user')
                                <a href="{{ route('categories.all') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                    <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M208.3 64L432.3 64C458.8 64 480.4 85.8 479.4 112.2C479.2 117.5 479 122.8 478.7 128L528.3 128C554.4 128 577.4 149.6 575.4 177.8C567.9 281.5 514.9 338.5 457.4 368.3C441.6 376.5 425.5 382.6 410.2 387.1C390 415.7 369 430.8 352.3 438.9L352.3 512L416.3 512C434 512 448.3 526.3 448.3 544C448.3 561.7 434 576 416.3 576L224.3 576C206.6 576 192.3 561.7 192.3 544C192.3 526.3 206.6 512 224.3 512L288.3 512L288.3 438.9C272.3 431.2 252.4 416.9 233 390.6C214.6 385.8 194.6 378.5 175.1 367.5C121 337.2 72.2 280.1 65.2 177.6C63.3 149.5 86.2 127.9 112.3 127.9L161.9 127.9C161.6 122.7 161.4 117.5 161.2 112.1C160.2 85.6 181.8 63.9 208.3 63.9zM165.5 176L113.1 176C119.3 260.7 158.2 303.1 198.3 325.6C183.9 288.3 172 239.6 165.5 176zM444 320.8C484.5 297 521.1 254.7 527.3 176L475 176C468.8 236.9 457.6 284.2 444 320.8z"/></svg>
                                    <span class="text-md font-semibold text-black">Categories</span>
                                </a>
                                <a href="{{ route('executives') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                    <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M320 128C241 128 175.3 185.3 162.3 260.7C171.6 257.7 181.6 256 192 256L208 256C234.5 256 256 277.5 256 304L256 400C256 426.5 234.5 448 208 448L192 448C139 448 96 405 96 352L96 288C96 164.3 196.3 64 320 64C443.7 64 544 164.3 544 288L544 456.1C544 522.4 490.2 576.1 423.9 576.1L336 576L304 576C277.5 576 256 554.5 256 528C256 501.5 277.5 480 304 480L336 480C362.5 480 384 501.5 384 528L384 528L424 528C463.8 528 496 495.8 496 456L496 435.1C481.9 443.3 465.5 447.9 448 447.9L432 447.9C405.5 447.9 384 426.4 384 399.9L384 303.9C384 277.4 405.5 255.9 432 255.9L448 255.9C458.4 255.9 468.3 257.5 477.7 260.6C464.7 185.3 399.1 127.9 320 127.9z" /></svg>
                                    <span class="text-md font-semibold text-black">Contact Us</span>
                                </a>
                                @if($appSettings->facebook_page_url)
                                    <a href="{{ $appSettings->facebook_page_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                        <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M576 320C576 178.6 461.4 64 320 64S64 178.6 64 320c0 127.7 93.6 233.5 216 252.7V394H215V320h65v-56.4c0-64.2 38.3-99.6 96.8-99.6 28 0 57.2 5 57.2 5v63h-32.3c-31.8 0-41.7 19.7-41.7 39.9V320h71l-11.4 74H360v178.7C482.4 553.5 576 447.7 576 320z"/></svg>
                                        <span class="text-md font-semibold text-black">Our Facebook Page</span>
                                    </a>
                                @endif
                                <a href="{{ route('privacy-policy.show') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                    <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 234.5C512 217.5 505.3 201.2 493.3 189.2L386.7 82.7C374.7 70.7 358.5 64 341.5 64L192 64zM336 112L336 192C336 209.7 350.3 224 368 224L448 224L448 512L192 512L192 128L320 128C328.8 128 336 120.8 336 112zM248 320C234.7 320 224 330.7 224 344C224 357.3 234.7 368 248 368L392 368C405.3 368 416 357.3 416 344C416 330.7 405.3 320 392 320L248 320zM248 416C234.7 416 224 426.7 224 440C224 453.3 234.7 464 248 464L392 464C405.3 464 416 453.3 416 440C416 426.7 405.3 416 392 416L248 416z"/></svg>
                                    <span class="text-md font-semibold text-black">Privacy Policy</span>
                                </a>
                                @if($appSettings->app_download_url)
                                    <a href="{{ $appSettings->app_download_url }}" target="_blank" rel="noopener noreferrer" class="text-text-body flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                        <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M448 256C501 256 544 213 544 160C544 107 501 64 448 64C395 64 352 107 352 160C352 165.4 352.5 170.8 353.3 176L223.6 248.1C206.7 233.1 184.4 224 160 224C107 224 64 267 64 320C64 373 107 416 160 416C184.4 416 206.6 406.9 223.6 391.9L353.3 464C352.4 469.2 352 474.5 352 480C352 533 395 576 448 576C501 576 544 533 544 480C544 427 501 384 448 384C423.6 384 401.4 393.1 384.4 408.1L254.7 336C255.6 330.8 256 325.5 256 320C256 314.5 255.5 309.2 254.7 304L384.4 231.9C401.3 246.9 423.6 256 448 256z"/></svg>
                                        <span class="text-md font-semibold text-black">Share App</span>
                                    </a>
                                @endif
                                <button
                                    type="button"
                                    @click="mobileMenuOpen = false; deleteAccountModalOpen = true"
                                    class="flex items-center gap-3 border-b border-slate-200 pb-2.5 text-left hover:bg-red-50 transition"
                                >
                                    <svg class="size-6 text-red-600" fill="currentColor" viewBox="0 0 640 640"><path d="M232.7 69.9L224 96L128 96C110.3 96 96 110.3 96 128C96 145.7 110.3 160 128 160L512 160C529.7 160 544 145.7 544 128C544 110.3 529.7 96 512 96L416 96L407.3 69.9C402.9 56.8 390.7 48 376.9 48L263.1 48C249.3 48 237.1 56.8 232.7 69.9zM512 208L128 208L149.1 531.1C150.8 556.4 171.8 576 197.2 576L442.8 576C468.2 576 489.2 556.4 490.9 531.1L512 208z"/></svg>
                                    <span class="text-md font-semibold text-red-600">Delete Account</span>
                                </button>
                            @endif

                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                    <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M320.3 192L235.7 51.1C229.2 40.3 215.6 36.4 204.4 42L117.8 85.3C105.9 91.2 101.1 105.6 107 117.5L176.6 256.6C146.5 290.5 128.3 335.1 128.3 384C128.3 490 214.3 576 320.3 576C426.3 576 512.3 490 512.3 384C512.3 335.1 494 290.5 464 256.6L533.6 117.5C539.5 105.6 534.7 91.2 522.9 85.3L436.2 41.9C425 36.3 411.3 40.3 404.9 51L320.3 192zM351.1 334.5C352.5 337.3 355.1 339.2 358.1 339.6L408.2 346.9C415.9 348 418.9 357.4 413.4 362.9L377.1 398.3C374.9 400.5 373.9 403.5 374.4 406.6L383 456.5C384.3 464.1 376.3 470 369.4 466.4L324.6 442.8C321.9 441.4 318.6 441.4 315.9 442.8L271.1 466.4C264.2 470 256.2 464.2 257.5 456.5L266.1 406.6C266.6 403.6 265.6 400.5 263.4 398.3L227.1 362.9C221.5 357.5 224.6 348.1 232.3 346.9L282.4 339.6C285.4 339.2 288.1 337.2 289.4 334.5L311.8 289.1C315.2 282.1 325.1 282.1 328.6 289.1L351 334.5z"/></svg>
                                    <span class="text-md font-semibold text-black">Categories</span>
                                </a>
                                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                    <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M208.3 64L432.3 64C458.8 64 480.4 85.8 479.4 112.2C479.2 117.5 479 122.8 478.7 128L528.3 128C554.4 128 577.4 149.6 575.4 177.8C567.9 281.5 514.9 338.5 457.4 368.3C441.6 376.5 425.5 382.6 410.2 387.1C390 415.7 369 430.8 352.3 438.9L352.3 512L416.3 512C434 512 448.3 526.3 448.3 544C448.3 561.7 434 576 416.3 576L224.3 576C206.6 576 192.3 561.7 192.3 544C192.3 526.3 206.6 512 224.3 512L288.3 512L288.3 438.9C272.3 431.2 252.4 416.9 233 390.6C214.6 385.8 194.6 378.5 175.1 367.5C121 337.2 72.2 280.1 65.2 177.6C63.3 149.5 86.2 127.9 112.3 127.9L161.9 127.9C161.6 122.7 161.4 117.5 161.2 112.1C160.2 85.6 181.8 63.9 208.3 63.9zM165.5 176L113.1 176C119.3 260.7 158.2 303.1 198.3 325.6C183.9 288.3 172 239.6 165.5 176zM444 320.8C484.5 297 521.1 254.7 527.3 176L475 176C468.8 236.9 457.6 284.2 444 320.8z"/></svg>
                                    <span class="text-md font-semibold text-black">Products</span>
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                    <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M320 80C377.4 80 424 126.6 424 184C424 241.4 377.4 288 320 288C262.6 288 216 241.4 216 184C216 126.6 262.6 80 320 80zM96 152C135.8 152 168 184.2 168 224C168 263.8 135.8 296 96 296C56.2 296 24 263.8 24 224C24 184.2 56.2 152 96 152zM0 480C0 409.3 57.3 352 128 352C140.8 352 153.2 353.9 164.9 357.4C132 394.2 112 442.8 112 496L112 512C112 523.4 114.4 534.2 118.7 544L32 544C14.3 544 0 529.7 0 512L0 480zM521.3 544C525.6 534.2 528 523.4 528 512L528 496C528 442.8 508 394.2 475.1 357.4C486.8 353.9 499.2 352 512 352C582.7 352 640 409.3 640 480L640 512C640 529.7 625.7 544 608 544L521.3 544zM472 224C472 184.2 504.2 152 544 152C583.8 152 616 184.2 616 224C616 263.8 583.8 296 544 296C504.2 296 472 263.8 472 224zM160 496C160 407.6 231.6 336 320 336C408.4 336 480 407.6 480 496L480 512C480 529.7 465.7 544 448 544L192 544C174.3 544 160 529.7 160 512L160 496z"/></svg>
                                    <span class="text-md font-semibold text-black">Users</span>
                                </a>
                                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                    <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M160 64C124.7 64 96 92.7 96 128L96 512C96 547.3 124.7 576 160 576L448 576C483.3 576 512 547.3 512 512L512 128C512 92.7 483.3 64 448 64L160 64zM272 352L336 352C380.2 352 416 387.8 416 432C416 440.8 408.8 448 400 448L208 448C199.2 448 192 440.8 192 432C192 387.8 227.8 352 272 352zM248 256C248 225.1 273.1 200 304 200C334.9 200 360 225.1 360 256C360 286.9 334.9 312 304 312C273.1 312 248 286.9 248 256zM576 144C576 135.2 568.8 128 560 128C551.2 128 544 135.2 544 144L544 208C544 216.8 551.2 224 560 224C568.8 224 576 216.8 576 208L576 144zM576 272C576 263.2 568.8 256 560 256C551.2 256 544 263.2 544 272L544 336C544 344.8 551.2 352 560 352C568.8 352 576 344.8 576 336L576 272zM560 384C551.2 384 544 391.2 544 400L544 464C544 472.8 551.2 480 560 480C568.8 480 576 472.8 576 464L576 400C576 391.2 568.8 384 560 384z"/></svg>
                                    <span class="text-md font-semibold text-black">Contacts</span>
                                </a>
                                <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                    <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M415.9 344L225 344C227.9 408.5 242.2 467.9 262.5 511.4C273.9 535.9 286.2 553.2 297.6 563.8C308.8 574.3 316.5 576 320.5 576C324.5 576 332.2 574.3 343.4 563.8C354.8 553.2 367.1 535.8 378.5 511.4C398.8 467.9 413.1 408.5 416 344zM224.9 296L415.8 296C413 231.5 398.7 172.1 378.4 128.6C367 104.2 354.7 86.8 343.3 76.2C332.1 65.7 324.4 64 320.4 64C316.4 64 308.7 65.7 297.5 76.2C286.1 86.8 273.8 104.2 262.4 128.6C242.1 172.1 227.8 231.5 224.9 296zM176.9 296C180.4 210.4 202.5 130.9 234.8 82.7C137.1 116.2 66.4 198.1 53.8 296L176.9 296zM53.8 344C66.4 441.9 137.1 523.8 234.8 557.3C202.5 509.1 180.4 429.6 176.9 344L53.8 344zM463.9 344C460.4 429.6 438.3 509.1 406 557.3C503.7 523.8 574.4 441.9 587 344L463.9 344zM587 296C574.4 198.1 503.7 116.2 406 82.7C438.3 130.9 460.4 210.4 463.9 296L587 296z"/></svg>
                                    <span class="text-md font-semibold text-black">Settings</span>
                                </a>
                            @endif

                            <a onclick="event.preventDefault(); document.getElementById('desktop-logout-form').submit();" href="{{ route('logout') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"/></svg>
                                <span class="text-md font-semibold text-black">Logout</span>
                            </a>
                        </nav>
                    </div>
                @endauth

                @guest
                    <div class="flex items-center justify-between gap-3 border-b border-slate-100 bg-secondary px-6 py-4">
                        <a
                            href="{{ route('signin') }}"
                            class="rounded-lg bg-white px-4 py-2 font-semibold text-secondary"
                        >
                            Login
                        </a>
                        <button @click="theme = theme === 'dark' ? 'light' : 'dark'" class="p-1 text-lg transition-transform active:scale-95" aria-label="Toggle theme">
                            <span x-show="theme === 'dark'">🌙</span>
                            <span x-show="theme === 'light'">☀️</span>
                        </button>
                    </div>

                    <div class="grow overflow-y-auto px-6 py-4">
                        <nav class="flex flex-col gap-2.5">
                            <a href="{{ route('categories.all') }}" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M208.3 64L432.3 64C458.8 64 480.4 85.8 479.4 112.2C479.2 117.5 479 122.8 478.7 128L528.3 128C554.4 128 577.4 149.6 575.4 177.8C567.9 281.5 514.9 338.5 457.4 368.3C441.6 376.5 425.5 382.6 410.2 387.1C390 415.7 369 430.8 352.3 438.9L352.3 512L416.3 512C434 512 448.3 526.3 448.3 544C448.3 561.7 434 576 416.3 576L224.3 576C206.6 576 192.3 561.7 192.3 544C192.3 526.3 206.6 512 224.3 512L288.3 512L288.3 438.9C272.3 431.2 252.4 416.9 233 390.6C214.6 385.8 194.6 378.5 175.1 367.5C121 337.2 72.2 280.1 65.2 177.6C63.3 149.5 86.2 127.9 112.3 127.9L161.9 127.9C161.6 122.7 161.4 117.5 161.2 112.1C160.2 85.6 181.8 63.9 208.3 63.9zM165.5 176L113.1 176C119.3 260.7 158.2 303.1 198.3 325.6C183.9 288.3 172 239.6 165.5 176zM444 320.8C484.5 297 521.1 254.7 527.3 176L475 176C468.8 236.9 457.6 284.2 444 320.8z"/></svg>
                                <span class="text-md font-semibold text-black">Categories</span>
                            </a>

                            <a href="https://wa.me/?text={{ urlencode(config('app.url')) }}" target="_blank" class="flex items-center gap-3 border-b border-slate-200 pb-2.5 hover:bg-slate-50 transition">
                                <svg class="size-6 text-secondary-500" fill="currentColor" viewBox="0 0 640 640"><path d="M448 256C501 256 544 213 544 160C544 107 501 64 448 64C395 64 352 107 352 160C352 165.4 352.5 170.8 353.3 176L223.6 248.1C206.7 233.1 184.4 224 160 224C107 224 64 267 64 320C64 373 107 416 160 416C184.4 416 206.6 406.9 223.6 391.9L353.3 464C352.4 469.2 352 474.5 352 480C352 533 395 576 448 576C501 576 544 533 544 480C544 427 501 384 448 384C423.6 384 401.4 393.1 384.4 408.1L254.7 336C255.6 330.8 256 325.5 256 320C256 314.5 255.5 309.2 254.7 304L384.4 231.9C401.3 246.9 423.6 256 448 256z"/></svg>
                                <span class="text-md font-semibold text-black">Share App</span>
                            </a>
                        </nav>
                    </div>
                @endguest

                <div class="w-full px-6 mt-auto pt-4">
                    <img 
                        src="{{ asset('images/site-large-logo.png') }}"
                        class="w-full max-w-60"
                        alt="Site Large Logo"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile header ends -->

    <div
        x-show="guestProductModalOpen"
        x-transition.opacity
        class="fixed inset-0 z-[60] flex items-center justify-center bg-black/50 px-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="guest-product-title"
        style="display: none;"
    >
        <div
            x-show="guestProductModalOpen"
            x-transition.scale.origin.center
            @click.outside="guestProductModalOpen = false"
            class="w-full max-w-[420px] rounded-lg bg-background p-5 shadow-lg"
        >
            <div class="mb-5 flex items-start gap-3">
                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="size-5" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true"><path d="M320 64C178.6 64 64 178.6 64 320s114.6 256 256 256 256-114.6 256-256S461.4 64 320 64zM296 184c0-13.3 10.7-24 24-24s24 10.7 24 24v152c0 13.3-10.7 24-24 24s-24-10.7-24-24V184zm24 296c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/></svg>
                </div>
                <div>
                    <h2 id="guest-product-title" class="text-lg font-bold">Login to view details</h2>
                    <p class="mt-2 text-sm">
                        Please login to open product details and view pricing.
                    </p>
                </div>
            </div>

            <div class="flex gap-3">
                <button
                    type="button"
                    @click="guestProductModalOpen = false"
                    class="w-full rounded-lg border border-border px-4 py-2 text-base font-semibold"
                >
                    Cancel
                </button>
                <a
                    href="{{ route('signin') }}"
                    class="btn-secondary w-full px-4 py-2 text-center text-base font-semibold rounded-lg"
                >
                    Login
                </a>
            </div>
        </div>
    </div>

    @auth
        @if(auth()->user()->role === 'user')
            <div
                x-show="deleteAccountModalOpen"
                x-transition.opacity
                class="fixed inset-0 z-[60] flex items-center justify-center bg-black/50 px-4"
                role="dialog"
                aria-modal="true"
                aria-labelledby="delete-account-title"
                style="display: none;"
            >
                <div
                    x-show="deleteAccountModalOpen"
                    x-transition.scale.origin.center
                    @click.outside="deleteAccountModalOpen = false"
                    class="w-full max-w-[420px] rounded-lg bg-background p-5 shadow-lg"
                >
                    <div class="mb-5 flex items-start gap-3">
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                            <svg class="size-5" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true"><path d="M320 64C178.6 64 64 178.6 64 320s114.6 256 256 256 256-114.6 256-256S461.4 64 320 64zM296 184c0-13.3 10.7-24 24-24s24 10.7 24 24v152c0 13.3-10.7 24-24 24s-24-10.7-24-24V184zm24 296c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/></svg>
                        </div>
                        <div>
                            <h2 id="delete-account-title" class="text-lg font-bold">Delete Account?</h2>
                            <p class="mt-2 text-sm">
                                This will permanently delete your account. You will be signed out immediately.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="button"
                            @click="deleteAccountModalOpen = false"
                            class="w-full rounded-lg border border-border px-4 py-3 text-base font-semibold"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            onclick="document.getElementById('delete-account-form').submit();"
                            class="w-full rounded-lg bg-red-600 px-4 py-3 text-base font-semibold text-white"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @endauth
