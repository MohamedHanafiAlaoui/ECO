<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', \App\Models\Setting::get('store_name', 'Luxury Wooden Organizer Store'))</title>
    @if($favicon = \App\Models\Setting::get('store_favicon'))
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon) }}">
    @endif
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('store_description', 'Premium luxury wooden desk organizers and accessories in the Middle East.'))">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'luxury-black': '#111111',
                        'luxury-white': '#fdfdfd',
                        'luxury-beige': '#f5f5f0',
                        'luxury-wood': '#8b5a2b',
                    },
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        body { font-family: 'Cairo', sans-serif; }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f5f5f0; }
        ::-webkit-scrollbar-thumb { background: #8b5a2b; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #6b4423; }
    </style>
    
    {!! \App\Models\Setting::get('header_code') !!}

    <!-- Facebook Pixel Code -->
    @if($pixelId = \App\Models\Setting::get('facebook_pixel_id'))
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '{{ $pixelId }}');
    fbq('track', 'PageView');
    @if(session('pixel_add_to_cart'))
    fbq('track', 'AddToCart', {
        content_ids: ['{{ session('pixel_add_to_cart') }}'],
        content_type: 'product',
        value: {{ session('pixel_add_to_cart_value') }},
        currency: '{{ \App\Models\Setting::get('store_currency', 'MAD') }}'
    });
    @endif
    @stack('pixel_events')
    </script>
    <noscript><img height="1" width="1" style="display:none;" src="https://www.facebook.com/tr?id={{ $pixelId }}&ev=PageView&noscript=1"/></noscript>
    @endif
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                darkMode: localStorage.getItem('darkMode') === 'true',
                toggle() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('darkMode', this.darkMode);
                }
            })
        })
    </script>
</head>
<body class="bg-luxury-beige text-luxury-black antialiased flex flex-col min-h-screen transition-colors duration-300 dark:bg-gray-900 dark:text-gray-100" 
      :class="{ 'dark': $store.theme.darkMode }">
    
    @include('components.navbar')

    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Floating Chatbot -->
    <div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50">
        <div x-show="open" @click.away="open = false" x-transition class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-4 mb-4 w-72 text-right">
            <h4 class="font-bold text-luxury-wood mb-2 border-b pb-2">مرحباً بك! 👋</h4>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-3 border-b pb-2">كيف يمكننا مساعدتك اليوم؟</p>
            <div class="space-y-2">
                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '212600000000') }}" target="_blank" class="block w-full text-center bg-green-500 text-white rounded py-2 text-sm hover:bg-green-600 transition">
                    تواصل معنا عبر واتساب
                </a>
            </div>
        </div>
        <button @click="open = !open" class="bg-luxury-wood text-white rounded-full p-4 shadow-lg hover:bg-[#6b4423] transition transform hover:scale-110 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </button>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'slide',
                once: true,
            });
        });
    </script>
    @stack('scripts')
    
    {!! \App\Models\Setting::get('footer_code') !!}
</body>
</html>

