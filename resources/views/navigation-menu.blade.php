<nav x-data="{ open: false }" class="bg-slate-900 backdrop-blur-md border-b border-slate-800 shadow-xl sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Magic Quill Logo" class="h-10 w-auto group-hover:scale-110 transition-all duration-300">
                        @elseif(file_exists(public_path('images/logo.jpg')))
                            <img src="{{ asset('images/logo.jpg') }}" alt="Magic Quill Logo" class="h-10 w-auto group-hover:scale-110 transition-all duration-300">
                        @elseif(file_exists(public_path('images/logo.svg')))
                            <img src="{{ asset('images/logo.svg') }}" alt="Magic Quill Logo" class="h-10 w-auto group-hover:scale-110 transition-all duration-300">
                        @else
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                S
                            </div>
                        @endif
                        <span class="text-xl font-bold text-white hidden md:block">
                            Magic Quill
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:ml-10 lg:flex items-center gap-1">
                    <!-- Primary Navigation Group -->
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors text-slate-200 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="text-sm font-semibold">Home</span>
                    </x-nav-link>
                    
                    <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.*')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors text-slate-200 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="text-sm font-semibold">Shop</span>
                    </x-nav-link>

                    <!-- Divider -->
                    <div class="h-6 w-px bg-slate-700 mx-2"></div>

                    <!-- Shopping Navigation Group -->
                    <x-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.*')" class="relative inline-flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors text-slate-200 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="text-sm font-semibold">Cart</span>
                        @php
                            $cartCount = 0;
                            if (Auth::check()) {
                                $cart = \App\Models\Cart::where('customer_id', Auth::id())->first();
                                if ($cart) {
                                    $cartCount = $cart->cartItems()->count();
                                }
                            }
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center shadow-md">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </x-nav-link>
                    
                    <x-nav-link href="{{ route('orders.index') }}" :active="request()->routeIs('orders.*')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors text-slate-200 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="text-sm font-semibold">Orders</span>
                    </x-nav-link>

                    <!-- Divider -->
                    <div class="h-6 w-px bg-slate-700 mx-2"></div>

                    <!-- Info Pages Group -->
                    <x-nav-link href="{{ url('/about') }}" :active="request()->is('about')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors text-slate-200 hover:text-white">
                        <span class="text-sm font-semibold">About</span>
                    </x-nav-link>

                    <x-nav-link href="{{ url('/contact') }}" :active="request()->is('contact')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors text-slate-200 hover:text-white">
                        <span class="text-sm font-semibold">Contact</span>
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden lg:flex lg:items-center lg:ml-6 gap-3">
                <!-- Settings Dropdown -->
                @auth
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-indigo-300 transition">
                                    <img class="h-9 w-9 rounded-full object-cover ring-2 ring-indigo-500 ring-offset-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="inline-flex items-center px-4 py-2.5 border border-slate-700 text-sm leading-4 font-medium rounded-full text-slate-200 bg-slate-800 hover:bg-slate-700 hover:border-slate-600 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-all duration-200 shadow-sm">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                        <span class="font-semibold">{{ Auth::user()->name }}</span>
                                    </div>
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ __('Profile') }}
                                </div>
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                        {{ __('API Tokens') }}
                                    </div>
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    <div class="flex items-center gap-2 text-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        {{ __('Log Out') }}
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endauth
            </div>

            <!-- Hamburger Menu -->
            <div class="-mr-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-slate-800 bg-slate-800">
        <div class="pt-3 pb-3 space-y-1 px-2">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="rounded-lg">
                <div class="flex items-center gap-3 py-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-semibold">{{ __('Dashboard') }}</span>
                </div>
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.*')" class="rounded-lg">
                <div class="flex items-center gap-3 py-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="font-semibold">{{ __('Shop') }}</span>
                </div>
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.*')" class="rounded-lg relative">
                <div class="flex items-center gap-3 py-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="font-semibold">{{ __('Cart') }}</span>
                    @php
                        $cartCount = 0;
                        if (Auth::check()) {
                            $cart = \App\Models\Cart::where('customer_id', Auth::id())->first();
                            if ($cart) {
                                $cartCount = $cart->cartItems()->count();
                            }
                        }
                    @endphp
                    @if($cartCount > 0)
                        <span class="ml-auto bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold rounded-full px-2.5 py-0.5 shadow-md">
                            {{ $cartCount }}
                        </span>
                    @endif
                </div>
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('orders.index') }}" :active="request()->routeIs('orders.*')" class="rounded-lg">
                <div class="flex items-center gap-3 py-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="font-semibold">{{ __('Orders') }}</span>
                </div>
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ url('/about') }}" :active="request()->is('about')" class="rounded-lg">
                <div class="flex items-center gap-3 py-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-semibold">{{ __('About Us') }}</span>
                </div>
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ url('/contact') }}" :active="request()->is('contact')" class="rounded-lg">
                <div class="flex items-center gap-3 py-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span class="font-semibold">{{ __('Contact Us') }}</span>
                </div>
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-4 border-t border-slate-800 bg-slate-900">
            <div class="flex items-center px-4 mb-3">
                <div class="shrink-0 mr-3">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="h-12 w-12 rounded-full object-cover ring-2 ring-blue-500" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @else
                        <div class="h-12 w-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div>
                    <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="rounded-lg">
                    <div class="flex items-center gap-3 py-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="font-semibold">{{ __('Profile') }}</span>
                    </div>
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')" class="rounded-lg">
                        <div class="flex items-center gap-3 py-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            <span class="font-semibold">{{ __('API Tokens') }}</span>
                        </div>
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();" 
                                   class="rounded-lg hover:bg-red-50">
                        <div class="flex items-center gap-3 py-2 text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="font-bold">{{ __('Log Out') }}</span>
                        </div>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
