@extends('layouts.app')

@section('title', 'سلة التسوق - متجر المنظمات الخشبية')

@section('content')
<div class="py-12 bg-luxury-beige dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-10 text-right">سلة التسوق</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                @if(count($cart) > 0)
                <div class="space-y-6">
                    @foreach($cart as $id => $details)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm flex flex-col sm:flex-row items-center gap-6 text-right">
                        <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ $details['image'] ? asset('storage/'.$details['image']) : 'https://via.placeholder.com/200x200.png?text=Product' }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-lg font-bold text-luxury-black dark:text-white mb-1">{{ $details['name'] }}</h3>
                            <p class="text-luxury-wood font-bold">{{ number_format($details['price'], 2) }} {{ \App\Models\Setting::get('store_currency', 'ر.س') }}</p>
                        </div>
                        <div class="flex items-center border-2 border-gray-50 rounded-xl overflow-hidden h-10">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 text-center border-none focus:ring-0 font-bold" onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class="text-left">
                            <p class="font-bold mb-2">{{ number_format($details['price'] * $details['quantity'], 2) }} {{ \App\Models\Setting::get('store_currency', 'ر.س') }}</p>
                            <a href="{{ route('cart.remove', $id) }}" class="text-red-500 hover:text-red-700 text-sm flex items-center gap-1">
                                حذف
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-20 text-center shadow-sm">
                    <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">سلة التسوق فارغة</h2>
                    <p class="text-gray-500 mb-8">لم تقم بإضافة أي منتجات للسلة بعد.</p>
                    <a href="{{ route('home') }}" class="bg-luxury-wood text-white px-8 py-3 rounded-xl font-bold hover:bg-[#6b4423] transition">ابدأ التسوق</a>
                </div>
                @endif
            </div>

            <!-- Summary -->
            @if(count($cart) > 0)
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm text-right sticky top-28">
                    <h2 class="text-xl font-bold mb-6 border-b pb-4">ملخص الطلب</h2>
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between font-medium">
                            <span class="text-gray-500">المجموع الفرعي</span>
                            <span>{{ number_format($total, 2) }} {{ \App\Models\Setting::get('store_currency', 'ر.س') }}</span>
                        </div>
                        <div class="flex justify-between font-medium">
                            <span class="text-gray-500">الشحن</span>
                            <span class="text-green-500">مجاني</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between text-xl font-bold">
                            <span>الإجمالي</span>
                            <span class="text-luxury-wood">{{ number_format($total, 2) }} {{ \App\Models\Setting::get('store_currency', 'ر.س') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="block w-full bg-luxury-wood text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-[#6b4423] transition shadow-lg">إتمام الطلب</a>
                    <div class="mt-6 flex items-center justify-center gap-3 grayscale opacity-50">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-4">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

