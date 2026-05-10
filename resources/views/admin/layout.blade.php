<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - {{ \App\Models\Setting::get('store_name', 'Luxury Store') }}</title>
    @if($favicon = \App\Models\Setting::get('store_favicon'))
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon) }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'luxury-black': '#111111',
                        'luxury-wood': '#8b5a2b',
                    }
                }
            }
        }
    </script>
    <style>body { font-family: 'Cairo', sans-serif; }</style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-luxury-black text-white flex-shrink-0">
            <div class="p-6 text-center border-b border-gray-800">
                @if($logo = \App\Models\Setting::get('store_logo'))
                    <img src="{{ asset('storage/' . $logo) }}" class="h-10 mx-auto mb-2" alt="Logo">
                @else
                    <h1 class="text-xl font-bold text-luxury-wood">{{ \App\Models\Setting::get('store_name', 'متجر المنظمات') }}</h1>
                @endif
                <p class="text-xs text-gray-500 mt-1">لوحة التحكم</p>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-luxury-wood text-white' : 'text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    الرئيسية
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800 transition {{ request()->routeIs('admin.orders') ? 'bg-luxury-wood text-white' : 'text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    الطلبات
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800 transition {{ request()->routeIs('admin.products*') ? 'bg-luxury-wood text-white' : 'text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    المنتجات
                </a>
                <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800 transition {{ request()->routeIs('admin.categories*') ? 'bg-luxury-wood text-white' : 'text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    الأقسام
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800 transition {{ request()->routeIs('admin.settings*') ? 'bg-luxury-wood text-white' : 'text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    الإعدادات
                </a>
                <a href="{{ route('admin.logs') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800 transition {{ request()->routeIs('admin.logs*') ? 'bg-luxury-wood text-white' : 'text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    سجل النشاطات
                </a>
                <a href="{{ route('admin.logout') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-red-900/20 text-red-400 mt-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    تسجيل الخروج
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow">
            <header class="bg-white shadow-sm p-6 flex justify-between items-center">
                <div class="text-gray-500">مرحباً، {{ session('admin_name') }}</div>
                <div class="font-bold">@yield('title')</div>
            </header>
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>

