<footer class="bg-luxury-black text-luxury-white pt-16 pb-8 border-t-4 border-luxury-wood">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-right">
            <!-- Brand -->
            <div data-aos="fade-up">
                <h3 class="text-2xl font-bold mb-4 text-luxury-wood">{{ \App\Models\Setting::get('store_name', 'متجر المنظمات الخشبية') }}</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    نقدم لك أرقى المنظمات الخشبية واكسسوارات المكاتب المصنوعة يدوياً لضمان الفخامة والترتيب في مساحة عملك.
                </p>
            </div>

            <!-- Links -->
            <div data-aos="fade-up" data-aos-delay="100">
                <h4 class="text-lg font-bold mb-4 border-b border-gray-700 pb-2 inline-block">روابط هامة</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-luxury-wood transition flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-luxury-wood"></span> الرئيسية</a></li>
                    <li><a href="#categories" class="text-gray-400 hover:text-luxury-wood transition flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-luxury-wood"></span> الأقسام</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-luxury-wood transition flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-luxury-wood"></span> سياسة الخصوصية</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div data-aos="fade-up" data-aos-delay="200">
                <h4 class="text-lg font-bold mb-4 border-b border-gray-700 pb-2 inline-block">تواصل معنا</h4>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-luxury-wood" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        {{ \App\Models\Setting::get('store_email', 'contact@luxurywood.com') }}
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-luxury-wood" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        {{ \App\Models\Setting::get('store_phone', '+212 600 000 000') }}
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('store_name', 'متجر المنظمات الخشبية') }}. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</footer>

