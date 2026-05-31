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
                       class="nav-link text-base font-medium {{ request()->routeIs('contact') ? 'active' : '' }}"
                       >
                        Contact
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
                            class="flex items-center gap-2 rounded-full p-1 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:bg-slate-50 transition-colors"
                            aria-haspopup="true"
                            :aria-expanded="profileDropdownOpen.toString()"
                        >
                            <img 
                                class="h-9 w-9 rounded-full border border-slate-200 object-cover shadow-sm" 
                                src="{{ Vite::asset('resources/images/user-placeholder.png') }}"
                                alt="User profile"
                            >
                            <span class="text-sm font-semibold text-slate-700 pr-1">{{ auth()->user()->name ?? 'Olivia Wilde' }}</span>
                            <i data-lucide="chevron-down" class="h-4 w-4 text-slate-400"></i>
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
                class="relative flex w-full max-w-xs flex-col bg-white pb-4 shadow-2xl"
            >
                <!-- Top Header: Logo & Close Button -->
                <div class="flex h-16 items-center justify-between px-6 border-b border-slate-100">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white shadow">
                            <i data-lucide="layers" class="h-4.5 w-4.5"></i>
                        </div>
                        <span class="text-lg font-bold tracking-tight text-slate-900">
                            {{ config('app.name', 'Apex') }}<span class="text-indigo-600">Flow</span>
                        </span>
                    </a>
                    <button 
                        @click="mobileMenuOpen = false"
                        type="button" 
                        class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 hover:text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        <span class="sr-only">Close menu</span>
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>

                <!-- Navigation Links List (Stacked) -->
                <div class="flex-1 overflow-y-auto px-4 py-4">
                    <nav class="space-y-1">
                        <a href="{{ route('signin') }}" 
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-semibold {{ request()->routeIs('dashboard') ? 'text-indigo-600 bg-indigo-50/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i data-lucide="layout-dashboard" class="h-5 w-5"></i> Dashboard
                        </a>
                        <a href="{{ route('signin') }}" 
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium {{ request()->routeIs('projects.*') ? 'text-indigo-600 bg-indigo-50/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i data-lucide="folder-kanban" class="h-5 w-5 text-slate-400"></i> Projects
                        </a>
                        <a href="{{ route('signin') }}" 
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium {{ request()->routeIs('tasks.*') ? 'text-indigo-600 bg-indigo-50/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i data-lucide="check-square" class="h-5 w-5 text-slate-400"></i> Tasks
                        </a>
                        <a href="{{ route('signin') }}" 
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium {{ request()->routeIs('analytics') ? 'text-indigo-600 bg-indigo-50/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i data-lucide="line-chart" class="h-5 w-5 text-slate-400"></i> Analytics
                        </a>
                        <a href="{{ route('signin') }}" 
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium {{ request()->routeIs('settings') ? 'text-indigo-600 bg-indigo-50/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i data-lucide="settings" class="h-5 w-5 text-slate-400"></i> Settings
                        </a>
                    </nav>
                </div>

                <!-- Bottom Profile Info section (Always visible in mobile drawer bottom) -->
                <div class="border-t border-slate-100 px-6 pt-4 pb-2">
                        <div class="flex items-center gap-3">
                            <img 
                                class="h-11 w-11 rounded-full border border-slate-200 object-cover shadow-sm" 
                             src="{{ Vite::asset('resources/images/user-placeholder.png') }}"
                                alt="User profile"
                            >
                            <div>
                                <p class="text-sm font-bold text-slate-800">User 1</p>
                                <p class="text-xs text-slate-500">example@gmail.com</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 space-y-1">
                            <a href="{{ route('signin') }}" class="flex items-center gap-2 rounded-lg py-2 text-sm font-medium text-slate-600 hover:text-indigo-600">
                                <i data-lucide="user" class="h-4 w-4 text-slate-400"></i> My Profile
                            </a>
                            
                            <!-- Mobile Logout Form (The secure Laravel Way) -->
                            <form method="POST" action="{{ route('logout') }}" id="mobile-logout-form" class="hidden">
                                @csrf
                            </form>
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();"
                               class="flex items-center gap-2 rounded-lg py-2 text-sm font-medium text-rose-600 hover:text-rose-700">
                                <i data-lucide="log-out" class="h-4 w-4"></i> Sign Out
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MOBILE SIDEBAR DRAWER & BACKDROP END -->