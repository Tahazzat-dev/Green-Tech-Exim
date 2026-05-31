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

                    <!-- Brand/Logo (Visible on all screens) -->
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5 shrink-0">
                        <div class="hidden lg:flex h-14 w-16 items-center justify-center">
                            <img  src="{{ Vite::asset('resources/images/site-logo.png') }}" alt="Site logo">
                        </div>
                        <span class="text-xl font-bold tracking-tight text-white lg:text-secondary">
                            Green Tech Exim
                        </span>
                    </a>

                    <span></span>
                </div>

                <!-- DESKTOP NAVIGATION (Visible only on >= lg) -->
                <nav class="hidden lg:flex text-base lg:gap-10">
                    <a href="{{ route('signin') }}" 
                       class="nav-link text-base font-medium {{ request()->routeIs('categories') ? 'active' : '' }}"
                       >
                        Categories
                    </a>
                    <a href="{{ route('signin') }}" 
                       class="nav-link text-base font-medium {{ request()->routeIs('trophies') ? 'active' : '' }}"
                       >
                        Trophies
                    </a>
                    <a href="{{ route('signin') }}" 
                      class="nav-link text-base font-medium {{ request()->routeIs('users') ? 'active' : '' }}"
                      >
                        Users
                    </a>
                    <a href="{{ route('signin') }}" 
                       class="nav-link text-base font-medium {{ request()->routeIs('contacts') ? 'active' : '' }}"
                       >
                        Contacts
                    </a>
                    <button @click="theme = theme === 'dark' ? 'light' : 'dark'" class="text-base w-auto transition" >
                        <span x-show="theme=='dark'">🌙</span>
                        <span x-show="theme=='light'">☀️</span>
                    </button>
                </nav>

                <!-- DESKTOP RIGHT SIDE -->
                <div class="hidden lg:relative lg:block">
                        <!-- Authenticated User Profile Dropdown Toggle Button -->
                        <button 
                            @click="profileDropdownOpen = !profileDropdownOpen"
                            type="button" 
                            class="flex items-center rounded-full border border-border focus-within:border-ring"
                            aria-haspopup="true"
                            :aria-expanded="profileDropdownOpen.toString()"
                        >
                            <img 
                                class="h-9 w-9 rounded-full" 
                                src="{{ Vite::asset('resources/images/user-placeholder.png') }}"
                                alt="User profile"
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
                            class="absolute right-0 mt-2.5 w-64 origin-top-right rounded-xl border border-slate-200/80 bg-white p-2 shadow-xl ring-1 ring-black/5 focus:outline-none"
                            style="display: none;"
                            role="menu" 
                            aria-orientation="vertical"
                        >
                            <!-- User Card Info Inside Dropdown -->
                            <div class="border-b border-slate-100 px-3 py-3">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Signed in as</p>
                                <p class="truncate text-sm font-bold text-slate-800">{{ auth()->user()->name ?? 'Olivia Wilde' }}</p>
                                <p class="truncate text-xs text-slate-500">{{ auth()->user()->email ?? 'olivia.wilde@apexflow.io' }}</p>
                            </div>
                            <!-- Menu Links -->
                            <div class="py-1">
                                <a href="{{ route('signin') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors" role="menuitem">
                                    <i data-lucide="user" class="h-4 w-4 text-slate-400"></i> My Profile
                                </a>
                                <a href="{{ route('signin') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors" role="menuitem">
                                    <i data-lucide="settings" class="h-4 w-4 text-slate-400"></i> Settings
                                </a>
                                <a href="{{ route('signin') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors" role="menuitem">
                                    <i data-lucide="bell" class="h-4 w-4 text-slate-400"></i> Notifications
                                </a>
                            </div>
                            <!-- Authentication Form Submission (The secure Laravel Way) -->
                            <div class="border-t border-slate-100 pt-1">
                                <form method="POST" action="{{ route('logout') }}" id="desktop-logout-form" class="hidden">
                                    @csrf
                                </form>
                                <a href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('desktop-logout-form').submit();"
                                   class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-rose-600 hover:bg-rose-50 transition-colors" 
                                   role="menuitem">
                                    <i data-lucide="log-out" class="h-4 w-4"></i> Sign out
                                </a>
                            </div>
                        </div>
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

    <!-- MOBILE SIDEBAR DRAWER & BACKDROP START (Left Slide-out) -->
    <div id="mobile-drawer" class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="mobileMenuOpen" style="display: none;">
        
        <!-- Backdrop Overlay (Smooth fade-in) -->
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
            <!-- Sidebar panel (Smooth Slide-in/Slide-out) -->
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                @click.away="mobileMenuOpen = false"
                class="relative flex w-full max-w-xs flex-col gap-8 bg-white pb-4 shadow-2xl"
            >
                <!-- Top Header: Logo & Close Button -->
                <div class="flex bg-secondary py-4 gap-3 items-center justify-between px-6 border-b border-slate-100">
                    <img 
                                class="h-14 w-14 rounded-full border-2 border-white" 
                                src="{{ Vite::asset('resources/images/user-placeholder.png') }}"
                                alt="User profile"
                      >
                      <div class="grow text-white ">
                        <h5 class="font-semibold text-xl" >Test User</h5>
                        <p class="font-semibold" >01777342354</p>
                      </div>
                </div>

                <!-- Navigation Links List (Stacked) -->
                <div class="overflow-y-auto px-6 py-4">
                    <nav class="space-y-1 flex flex-col gap-2.5">
                        <a href="{{ route('signin') }}" class="flex items-center gap-3 pb-2.5 border-b border-slate-300"  >
                            <svg class="size-7 text-secondary-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M320 128C241 128 175.3 185.3 162.3 260.7C171.6 257.7 181.6 256 192 256L208 256C234.5 256 256 277.5 256 304L256 400C256 426.5 234.5 448 208 448L192 448C139 448 96 405 96 352L96 288C96 164.3 196.3 64 320 64C443.7 64 544 164.3 544 288L544 456.1C544 522.4 490.2 576.1 423.9 576.1L336 576L304 576C277.5 576 256 554.5 256 528C256 501.5 277.5 480 304 480L336 480C362.5 480 384 501.5 384 528L384 528L424 528C463.8 528 496 495.8 496 456L496 435.1C481.9 443.3 465.5 447.9 448 447.9L432 447.9C405.5 447.9 384 426.4 384 399.9L384 303.9C384 277.4 405.5 255.9 432 255.9L448 255.9C458.4 255.9 468.3 257.5 477.7 260.6C464.7 185.3 399.1 127.9 320 127.9z" /></svg>
                            <span class="text-md font-semibold text-black" >Contact Us</span>
                        </a>
                         <a href="{{ route('signin') }}" class="flex items-center gap-3 pb-2.5 border-b border-slate-300"  >
                            <svg class="size-7 text-secondary-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M448 256C501 256 544 213 544 160C544 107 501 64 448 64C395 64 352 107 352 160C352 165.4 352.5 170.8 353.3 176L223.6 248.1C206.7 233.1 184.4 224 160 224C107 224 64 267 64 320C64 373 107 416 160 416C184.4 416 206.6 406.9 223.6 391.9L353.3 464C352.4 469.2 352 474.5 352 480C352 533 395 576 448 576C501 576 544 533 544 480C544 427 501 384 448 384C423.6 384 401.4 393.1 384.4 408.1L254.7 336C255.6 330.8 256 325.5 256 320C256 314.5 255.5 309.2 254.7 304L384.4 231.9C401.3 246.9 423.6 256 448 256z"/></svg>
                            <span class="text-md font-semibold text-black" >Contact Us</span>
                        </a>
                         <a href="{{ route('signin') }}" class="flex items-center gap-3 pb-2.5 border-b border-slate-300"  >
                            <svg class="size-7 text-secondary-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"/></svg>
                            <span class="text-md font-semibold text-black" >Logout</span>
                        </a>
                    </nav>
                </div>

                <!-- site logo -->
                 <div class="w-full px-6">
                    <img 
                    src="{{ Vite::asset('resources/images/site-large-logo.png') }}"
                    class="w-full max-w-60"
                     alt="Site Large Logo">
                 </div>
            </div>
        </div>
    </div>
    <!-- MOBILE SIDEBAR DRAWER & BACKDROP END -->