<nav class="bg-luxury-white/90 backdrop-blur-md dark:bg-gray-900/90 shadow-sm fixed w-full z-40 transition-colors duration-300" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2 group">
                    @if($logo = \App\Models\Setting::get('store_logo'))
                        <img src="{{ asset('storage/' . $logo) }}" class="h-12 w-auto" alt="{{ \App\Models\Setting::get('store_name', 'Luxury Wood') }}">
                    @else
                        <div class="w-10 h-10 bg-luxury-wood rounded-full flex items-center justify-center text-white font-bold text-xl group-hover:scale-105 transition transform shadow-md">
                            {{ substr(\App\Models\Setting::get('store_name', 'M'), 0, 1) }}
                        </div>
                    @endif
                    <span class="font-bold text-2xl text-luxury-black dark:text-white tracking-wide">
                        {{ \App\Models\Setting::get('store_name', 'متجر المنظمات الخشبية') }}
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex sm:items-center sm:gap-8">
                <a href="{{ route('home') }}" class="text-luxury-black dark:text-gray-200 hover:text-luxury-wood dark:hover:text-luxury-wood font-semibold transition px-2 py-1 relative group">
                    الرئيسية
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-luxury-wood transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('home') }}#categories" class="text-luxury-black dark:text-gray-200 hover:text-luxury-wood dark:hover:text-luxury-wood font-semibold transition px-2 py-1 relative group">
                    الأقسام
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-luxury-wood transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <!-- Icons -->
            <div class="hidden sm:flex sm:items-center sm:gap-6">
                <button @click="$store.theme.toggle()" class="p-2.5 rounded-xl bg-gray-50 dark:bg-gray-800 text-luxury-black dark:text-white hover:bg-luxury-wood/10 hover:text-luxury-wood transition-all duration-300 shadow-inner">
                    <svg x-show="!$store.theme.darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="$store.theme.darkMode" class="w-5 h-5 hidden" :class="{'hidden': !$store.theme.darkMode}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
                <a href="{{ route('cart.index') }}" class="text-luxury-black dark:text-white hover:text-luxury-wood transition relative group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="absolute -top-2 -right-2 bg-luxury-wood text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center shadow-sm group-hover:scale-110 transition">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden gap-4">
                <a href="{{ route('cart.index') }}" class="text-luxury-black dark:text-white relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="absolute -top-2 -right-2 bg-luxury-wood text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-luxury-black dark:text-white hover:text-luxury-wood transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition class="sm:hidden bg-white dark:bg-gray-900 border-t dark:border-gray-800">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-luxury-black dark:text-gray-200 hover:text-luxury-wood hover:bg-gray-50 dark:hover:bg-gray-800">الرئيسية</a>
            <a href="{{ route('home') }}#categories" class="block px-3 py-2 rounded-md text-base font-medium text-luxury-black dark:text-gray-200 hover:text-luxury-wood hover:bg-gray-50 dark:hover:bg-gray-800">الأقسام</a>
            <button @click="$store.theme.toggle()" class="w-full text-right px-3 py-2 rounded-md text-base font-medium text-luxury-black dark:text-gray-200 hover:text-luxury-wood hover:bg-gray-50 dark:hover:bg-gray-800">
                <span x-show="!$store.theme.darkMode">الوضع الداكن</span>
                <span x-show="$store.theme.darkMode" class="hidden" :class="{'hidden': !$store.theme.darkMode}">الوضع الفاتح</span>
            </button>
        </div>
    </div>
</nav>

