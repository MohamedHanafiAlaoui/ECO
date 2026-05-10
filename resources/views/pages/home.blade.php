@extends('layouts.app')

@section('content')
<!-- Hero Slider Section -->
<section class="relative overflow-hidden bg-luxury-black">
    <div class="swiper mainHeroSwiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide relative h-[60vh] md:h-[80vh] flex items-center justify-center">
                <div class="absolute inset-0">
                    <img src="https://cdn.youcan.shop/stores/0656ecb6d8e120b6a7b467096f1b4130/others/rWlVLhC1coqz1D8SnyR7u8XfoPKFLMEheEszHsic.png" class="w-full h-full object-cover opacity-80" alt="Slider 1">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="relative z-10 text-center text-white px-4">
                    <h2 class="text-4xl md:text-7xl font-black mb-6" data-aos="fade-down">إبداع الخشب في مكتبك</h2>
                    <p class="text-lg md:text-2xl mb-10 max-w-2xl mx-auto opacity-90" data-aos="fade-up" data-aos-delay="200">اكتشف أرقى المنظمات الخشبية المصممة بعناية لتناسب ذوقك الرفيع.</p>
                    <div class="flex flex-col md:flex-row gap-4 justify-center" data-aos="zoom-in" data-aos-delay="400">
                        <a href="{{ route('products.index') }}" class="bg-luxury-wood text-white px-10 py-4 rounded-full font-black text-lg hover:bg-[#6b4423] transition shadow-2xl">تسوق الآن</a>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="swiper-slide relative h-[60vh] md:h-[80vh] flex items-center justify-center">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1596431114510-410d80c0587a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" class="w-full h-full object-cover opacity-70" alt="Slider 2">
                    <div class="absolute inset-0 bg-black/40"></div>
                </div>
                <div class="relative z-10 text-center text-white px-4">
                    <h2 class="text-4xl md:text-7xl font-black mb-6">تنظيم مثالي.. لمسة ملكية</h2>
                    <p class="text-lg md:text-2xl mb-10 max-w-2xl mx-auto opacity-90">حوّل مساحة عملك إلى قطعة فنية مع منتجاتنا الفريدة.</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-white text-luxury-black px-10 py-4 rounded-full font-black text-lg hover:bg-gray-100 transition shadow-2xl">استكشف المجموعة</a>
                </div>
            </div>
        </div>
        <!-- Pagination & Navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next !text-white after:!text-2xl"></div>
        <div class="swiper-button-prev !text-white after:!text-2xl"></div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.mainHeroSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
        });
    });
</script>

<!-- Categories Section -->
<section id="categories" class="py-20 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-luxury-black dark:text-white mb-4">أقسام المتجر</h2>
            <div class="w-20 h-1 bg-luxury-wood mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <div class="relative group h-40 rounded-3xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700 cursor-pointer transition hover:shadow-xl hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Background Gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-luxury-wood/10 to-luxury-wood/5 group-hover:from-luxury-wood/20 group-hover:to-luxury-wood/10 transition-colors"></div>
                
                <div class="absolute inset-0 flex items-center justify-center p-6 text-center">
                    <div>
                        <h3 class="text-xl font-black text-luxury-black dark:text-white mb-2 group-hover:text-luxury-wood transition-colors">{{ $category->name }}</h3>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">تصفح الآن</p>
                    </div>
                </div>
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="absolute inset-0 z-10"></a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section id="featured" class="py-20 bg-luxury-beige dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-16" data-aos="fade-up">
            <div class="text-right mb-8 md:mb-0">
                <h2 class="text-3xl md:text-4xl font-bold text-luxury-black dark:text-white mb-4">المنتجات المميزة</h2>
                <div class="w-20 h-1 bg-luxury-wood rounded-full"></div>
            </div>
            <a href="{{ route('products.index') }}" class="text-luxury-wood font-bold hover:underline">عرض جميع المنتجات &larr;</a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($featuredProducts as $product)
                @include('components.product-card', ['product' => $product, 'delay' => $loop->index * 100])
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-luxury-black dark:text-white mb-4">ماذا يقول عملاؤنا</h2>
            <div class="w-20 h-1 bg-luxury-wood mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @for($i = 0; $i < 3; $i++)
            <div class="bg-luxury-beige dark:bg-gray-900 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="flex text-yellow-400 mb-4">
                    @for($j = 0; $j < 5; $j++)
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 dark:text-gray-300 italic mb-6 leading-relaxed">"جودة الخشب استثنائية والتصميم يضيف لمسة من الفخامة لمكتبي. أنصح الجميع بالتعامل معهم."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-luxury-wood flex items-center justify-center text-white font-bold">ع</div>
                    <div>
                        <h4 class="font-bold text-luxury-black dark:text-white">عبدالله أحمد</h4>
                        <p class="text-sm text-gray-500">عميل مؤكد</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-luxury-beige dark:bg-gray-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-luxury-black dark:text-white mb-4">الأسئلة الشائعة</h2>
            <div class="w-20 h-1 bg-luxury-wood mx-auto rounded-full"></div>
        </div>
        
        <div class="space-y-4" x-data="{ active: null }">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden" data-aos="fade-up">
                <button @click="active = active === 1 ? null : 1" class="w-full flex justify-between items-center p-6 text-right font-bold text-lg text-luxury-black dark:text-white">
                    <span>كم يستغرق التوصيل؟</span>
                    <svg class="w-5 h-5 transform transition" :class="{'rotate-180': active === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="active === 1" class="p-6 pt-0 text-gray-600 dark:text-gray-300 border-t border-gray-100 dark:border-gray-700">
                    نستغرق عادة من 3 إلى 5 أيام عمل للتوصيل داخل المملكة.
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden" data-aos="fade-up">
                <button @click="active = active === 2 ? null : 2" class="w-full flex justify-between items-center p-6 text-right font-bold text-lg text-luxury-black dark:text-white">
                    <span>هل يوجد ضمان على المنتجات؟</span>
                    <svg class="w-5 h-5 transform transition" :class="{'rotate-180': active === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="active === 2" class="p-6 pt-0 text-gray-600 dark:text-gray-300 border-t border-gray-100 dark:border-gray-700">
                    نعم، نقدم ضماناً لمدة سنة ضد عيوب التصنيع.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

