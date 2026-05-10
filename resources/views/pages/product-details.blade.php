@extends('layouts.app')

@section('title', ($product->meta_title ?? $product->name) . ' - متجر المنظمات الخشبية')
@section('meta_description', $product->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($product->description), 160))

@section('content')
<div class="py-12 bg-luxury-beige dark:bg-gray-900 min-h-screen" x-data="{ mainImage: '{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/800x800.png?text=Product' }}' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl font-bold flex items-center justify-between animate-bounce">
            <span>{{ session('success') }}</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        @endif
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 space-x-reverse">
                <li><a href="{{ route('home') }}" class="hover:text-luxury-wood">الرئيسية</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/></svg>
                    <a href="#" class="hover:text-luxury-wood">{{ $product->category->name }}</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/></svg>
                    <span class="font-bold text-luxury-black dark:text-white">{{ $product->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Product Gallery -->
                <div class="p-4 md:p-8 bg-gray-50/50 dark:bg-gray-700/20">
                    <div class="relative rounded-[2rem] overflow-hidden mb-6 bg-white shadow-inner group">
                        <img :src="mainImage" 
                             alt="{{ $product->name }}" 
                             class="w-full h-auto aspect-square object-contain transition duration-500 transform hover:scale-105">
                        
                        @if($product->compare_at_price > $product->price)
                        <div class="absolute top-6 right-6 bg-red-500 text-white px-4 py-1 rounded-full text-xs font-black shadow-lg">
                            وفر {{ round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100) }}%
                        </div>
                        @endif
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-5 gap-3">
                        <!-- Main Image Thumb -->
                        <div @click="mainImage = '{{ asset('storage/'.$product->image) }}'" 
                             class="aspect-square rounded-2xl overflow-hidden border-2 cursor-pointer transition p-1 bg-white shadow-sm"
                             :class="mainImage === '{{ asset('storage/'.$product->image) }}' ? 'border-luxury-wood ring-2 ring-luxury-wood/20' : 'border-transparent hover:border-gray-200'">
                            <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover rounded-xl">
                        </div>
                        
                        <!-- Gallery Images -->
                        @if($product->images)
                            @foreach($product->images as $galleryImg)
                            <div @click="mainImage = '{{ asset('storage/'.$galleryImg) }}'" 
                                 class="aspect-square rounded-2xl overflow-hidden border-2 cursor-pointer transition p-1 bg-white shadow-sm"
                                 :class="mainImage === '{{ asset('storage/'.$galleryImg) }}' ? 'border-luxury-wood ring-2 ring-luxury-wood/20' : 'border-transparent hover:border-gray-200'">
                                <img src="{{ asset('storage/'.$galleryImg) }}" class="w-full h-full object-cover rounded-xl">
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-8 md:p-16 text-right flex flex-col justify-center">
                    <div class="flex items-center justify-end gap-3 mb-6">
                        <span class="bg-luxury-wood/10 text-luxury-wood text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">{{ $product->category->name }}</span>
                        @if($product->sku)
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">SKU: {{ $product->sku }}</span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-5xl font-black text-luxury-black dark:text-white mb-6 leading-tight">{{ $product->name }}</h1>
                    
                    <div class="flex items-center justify-end gap-3 mb-8">
                        <span class="text-gray-400 text-sm font-bold">({{ $product->reviews->count() }} تقييم)</span>
                        <div class="flex text-yellow-400">
                            @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-6 mb-10">
                        <div class="flex flex-col">
                            <span class="text-4xl md:text-5xl font-black text-luxury-wood">{{ number_format($product->price, 2) }} <span class="text-xl">{{ \App\Models\Setting::get('store_currency', 'د.م.') }}</span></span>
                            @if($product->compare_at_price)
                            <span class="text-lg text-gray-300 line-through font-bold mt-1">{{ number_format($product->compare_at_price, 2) }} {{ \App\Models\Setting::get('store_currency', 'د.م.') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Urgency & Info -->
                    <div class="space-y-4 mb-10">
                        <div class="flex items-center justify-end gap-4 text-gray-500 text-sm font-bold">
                            <span>شحن سريع لكافة مناطق المغرب</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="buy_now" value="1">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Quantity -->
                            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-700/30 rounded-2xl p-4 border border-gray-100" x-data="{ qty: 1 }">
                                <div class="flex items-center gap-4">
                                    <button type="button" @click="if(qty > 1) qty--" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center font-bold hover:bg-gray-100 transition">-</button>
                                    <input type="number" name="quantity" x-model="qty" class="w-10 text-center border-none bg-transparent font-black text-xl focus:ring-0" readonly>
                                    <button type="button" @click="qty++" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center font-bold hover:bg-gray-100 transition">+</button>
                                </div>
                                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">الكمية</span>
                            </div>

                            @if($product->weight)
                            <div class="bg-gray-50 dark:bg-gray-700/30 rounded-2xl p-4 border border-gray-100 flex items-center justify-between">
                                <span class="font-black text-luxury-black">{{ $product->weight }} كجم</span>
                                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">الوزن</span>
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="w-full bg-luxury-black text-white h-20 rounded-[1.5rem] font-black text-xl hover:bg-luxury-wood transition-all duration-500 shadow-2xl flex items-center justify-center relative overflow-hidden">
                            <span>اطلب الآن - دفع عند الاستلام</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Content Sections -->
        <div class="mt-20 space-y-24">
            <!-- Main Content (Rich Text) -->
            <section class="bg-white dark:bg-gray-800 rounded-[3rem] p-10 md:p-20 shadow-sm border border-gray-50 dark:border-gray-700 text-right">
                <h2 class="text-3xl md:text-4xl font-black text-luxury-black dark:text-white mb-12 flex items-center justify-end gap-4">
                    تفاصيل المنتج المميزة
                    <span class="w-12 h-1 bg-luxury-wood rounded-full"></span>
                </h2>
                <div class="prose prose-xl max-w-none dark:prose-invert leading-relaxed description-content">
                    {!! $product->description !!}
                </div>
            </section>

            <!-- Reviews Section -->
            <section class="max-w-5xl mx-auto text-right" data-aos="fade-up" x-data="{ reviewModal: false }">
                <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
                    <button @click="reviewModal = true" class="bg-luxury-wood text-white px-10 py-3 rounded-2xl font-black shadow-lg hover:shadow-luxury-wood/20 transition">أضف تقييمك الآن</button>
                    <h2 class="text-3xl font-black text-luxury-black dark:text-white">آراء العملاء المتميزين</h2>
                </div>

                <!-- Review Submission Modal -->
                <div x-show="reviewModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
                    <div @click="reviewModal = false" class="absolute inset-0 bg-luxury-black/40 backdrop-blur-md"></div>
                    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] w-full max-w-xl relative z-10 p-10 shadow-2xl border border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-8 flex-row-reverse">
                            <h2 class="text-2xl font-black">أضف تقييمك للمنتج</h2>
                            <button @click="reviewModal = false" class="text-gray-300 hover:text-gray-500 transition">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <form action="{{ route('product.review.store', $product->id) }}" method="POST" class="space-y-6 text-right">
                            @csrf
                             <div style="display:none;">
                                 <input type="text" name="website_url" value="">
                                 <input type="hidden" name="_form_time" value="{{ encrypt(time()) }}">
                             </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">اسمك الكامل</label>
                                <input type="text" name="name" required class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                            </div>

                            <div class="space-y-2" x-data="{ rating: 5 }">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">التقييم</label>
                                <div class="flex flex-row-reverse justify-end gap-2">
                                    <template x-for="i in 5">
                                        <button type="button" @click="rating = i" class="transition transform hover:scale-110">
                                            <svg class="w-8 h-8" :class="i <= rating ? 'text-yellow-400 fill-current' : 'text-gray-200'" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        </button>
                                    </template>
                                    <input type="hidden" name="rating" :value="rating">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">تعليقك</label>
                                <textarea name="comment" rows="4" class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20" placeholder="ما رأيك في جودة المنتج وتصميمه؟"></textarea>
                            </div>

                            <!-- Captcha -->
                            @include('components.captcha')

                            <button type="submit" class="w-full bg-luxury-black text-white py-5 rounded-[1.5rem] font-black hover:bg-luxury-wood transition shadow-xl">إرسال التقييم</button>
                        </form>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($product->reviews->where('is_approved', true) as $review)
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-sm border border-gray-50 dark:border-gray-700">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-400 text-xs font-bold">{{ $review->created_at->diffForHumans() }}</span>
                                <div class="flex text-yellow-400">
                                    @for($i = 0; $i < $review->rating; $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <h4 class="font-black text-luxury-black dark:text-white mb-2">{{ $review->name }}</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-100">
                            <p class="text-gray-400 font-bold italic text-lg">كن أول من يشاركنا تجربة شراء هذا المنتج الفاخر</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-32">
            <h2 class="text-3xl font-black text-luxury-black dark:text-white mb-12 text-right">منتجات فاخرة قد تثير اهتمامك</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                    @include('components.product-card', ['product' => $related])
                @endforeach
            </div>
        </div>
        @endif

        <!-- Explore Categories (Image-less) -->
        <div class="mt-32">
            <h2 class="text-3xl font-black text-luxury-black dark:text-white mb-12 text-right">استكشف الأقسام</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach(\App\Models\Category::where('is_active', true)->get() as $cat)
                <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="group relative bg-white dark:bg-gray-800 p-8 rounded-3xl text-center shadow-sm hover:shadow-xl transition border border-gray-50 dark:border-gray-700">
                    <div class="absolute inset-0 bg-gradient-to-br from-luxury-wood/5 to-transparent opacity-0 group-hover:opacity-100 transition rounded-3xl"></div>
                    <span class="relative font-black text-luxury-black dark:text-white group-hover:text-luxury-wood transition">{{ $cat->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .description-content img { border-radius: 1.5rem; margin: 2rem auto; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .description-content h2, .description-content h3 { font-weight: 900; color: #1a1a1a; margin-top: 2rem; margin-bottom: 1rem; }
    .description-content p { margin-bottom: 1.5rem; color: #4a4a4a; }
</style>
@endsection

@push('pixel_events')
<script>
    fbq('track', 'ViewContent', {
        content_name: '{{ $product->name }}',
        content_ids: ['{{ $product->id }}'],
        content_type: 'product',
        value: {{ $product->price }},
        currency: '{{ \App\Models\Setting::get('store_currency', 'MAD') }}'
    });
</script>
@endpush

