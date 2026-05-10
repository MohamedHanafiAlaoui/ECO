@extends('layouts.app')

@section('title', 'جميع المنتجات - ' . \App\Models\Setting::get('store_name', 'Luxury Store'))

@section('content')
<div class="py-12 bg-luxury-beige dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-8" data-aos="fade-up">
            <!-- Search Bar -->
            <div class="w-full md:w-96 order-2 md:order-1">
                <form action="{{ route('products.index') }}" method="GET" class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="ابحث عن منتج..." 
                        class="w-full bg-white dark:bg-gray-800 border-none rounded-2xl py-4 pr-12 pl-6 shadow-sm focus:ring-2 focus:ring-luxury-wood/20 font-bold transition">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-luxury-wood transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('products.index') }}" class="absolute left-4 top-1/2 -translate-y-1/2 text-red-400 hover:text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </form>
            </div>
            
            <div class="text-right order-1 md:order-2">
                <h1 class="text-4xl font-black text-luxury-black dark:text-white mb-2">كافة المنتجات</h1>
                <p class="text-gray-500">اكتشف تشكيلتنا الواسعة من المنظمات الخشبية الفاخرة</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1" data-aos="fade-left">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-sm sticky top-28 text-right border border-gray-50 dark:border-gray-700">
                    <h3 class="text-xl font-black mb-6 border-b pb-4">الأقسام</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('products.index') }}" class="flex justify-between items-center group transition {{ !request('category') ? 'text-luxury-wood font-bold' : 'text-gray-500 hover:text-luxury-wood' }}">
                                <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-lg text-xs font-bold">{{ \App\Models\Product::count() }}</span>
                                <span>الكل</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="flex justify-between items-center group transition {{ request('category') == $category->slug ? 'text-luxury-wood font-bold' : 'text-gray-500 hover:text-luxury-wood' }}">
                                <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-lg text-xs font-bold">{{ $category->products_count ?? $category->products()->count() }}</span>
                                <span>{{ $category->name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($products as $product)
                            @include('components.product-card', ['product' => $product, 'delay' => $loop->index * 50])
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-16">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-[3rem] p-20 text-center shadow-sm border-2 border-dashed border-gray-100 dark:border-gray-700">
                        <div class="w-24 h-24 bg-gray-50 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h2 class="text-2xl font-black text-gray-400">عذراً، لا توجد منتجات حالياً</h2>
                        <p class="text-gray-500 mt-2">يرجى تجربة البحث في قسم آخر أو العودة لاحقاً</p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-8 bg-luxury-wood text-white px-8 py-3 rounded-xl font-bold">عرض جميع المنتجات</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

