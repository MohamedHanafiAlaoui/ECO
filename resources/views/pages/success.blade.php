@extends('layouts.app')

@section('title', 'تم استلام طلبك بنجاح! - متجر المنظمات الخشبية')

@section('content')
<div class="py-20 bg-luxury-beige dark:bg-gray-900 min-h-[70vh] flex items-center">
    <div class="max-w-xl mx-auto px-4 text-center">
        <!-- Success Animation Container -->
        <div class="mb-10 relative inline-block" data-aos="zoom-out" data-aos-duration="1000">
            <div class="w-32 h-32 bg-green-500 rounded-full flex items-center justify-center shadow-2xl animate-bounce">
                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <!-- Sparkles -->
            <div class="absolute -top-4 -right-4 w-4 h-4 bg-yellow-400 rounded-full animate-ping"></div>
            <div class="absolute -bottom-4 -left-4 w-6 h-6 bg-luxury-wood rounded-full animate-pulse"></div>
        </div>
        
        <h1 class="text-4xl font-bold text-luxury-black dark:text-white mb-4">شكراً لطلبك!</h1>
        <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">تم استلام طلبك بنجاح. سيقوم فريقنا بمراجعته والتواصل معك قريباً لتأكيد الشحن.</p>
        
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm mb-10 text-right">
            <div class="flex justify-between mb-4 border-b pb-4">
                <span class="font-bold text-luxury-wood">{{ $order->order_number }}</span>
                <span class="text-gray-500">رقم الطلب</span>
            </div>
            <div class="flex justify-between mb-4 border-b pb-4">
                <span class="font-bold">{{ $order->full_name }}</span>
                <span class="text-gray-500">الاسم</span>
            </div>
            <div class="flex justify-between">
                <span class="font-bold">{{ number_format($order->total_amount, 2) }} {{ \App\Models\Setting::get('store_currency', 'ر.س') }}</span>
                <span class="text-gray-500">الإجمالي (الدفع عند الاستلام)</span>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="bg-luxury-wood text-white px-10 py-4 rounded-xl font-bold hover:bg-[#6b4423] transition shadow-md">العودة للرئيسية</a>
            <a href="https://wa.me/1234567890?text=استفسار عن الطلب رقم: {{ $order->order_number }}" target="_blank" class="bg-green-500 text-white px-10 py-4 rounded-xl font-bold hover:bg-green-600 transition shadow-md flex items-center justify-center gap-2">
                تواصل معنا عبر واتساب
            </a>
        </div>
    </div>
</div>
@endsection

@push('pixel_events')
<script>
    fbq('track', 'Purchase', {
        value: {{ $order->total_amount }},
        currency: '{{ \App\Models\Setting::get('store_currency', 'MAD') }}',
        content_ids: [{{ $order->items->pluck('product_id')->implode(',') }}],
        content_type: 'product'
    });
</script>
@endpush

