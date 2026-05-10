@extends('layouts.app')

@section('title', 'إتمام الطلب - متجر المنظمات الخشبية')

@section('content')
<div class="py-12 bg-luxury-beige dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-10 text-right">إتمام الطلب</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div style="display:none;">
                <input type="text" name="website_url" value="">
                <input type="hidden" name="_form_time" value="{{ encrypt(time()) }}">
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Checkout Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm text-right">
                        <h2 class="text-xl font-bold mb-8 flex items-center justify-end gap-3">
                            بيانات الشحن
                            <svg class="w-6 h-6 text-luxury-wood" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block font-bold">الاسم الكامل</label>
                                <input type="text" name="full_name" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 focus:ring-luxury-wood focus:border-luxury-wood" placeholder="الاسم ثلاثي">
                            </div>
                            <div class="space-y-2">
                                <label class="block font-bold">رقم الهاتف</label>
                                <input type="text" name="phone_number" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 focus:ring-luxury-wood focus:border-luxury-wood" placeholder="05xxxxxxxx">
                            </div>
                            <div class="space-y-2">
                                <label class="block font-bold">المدينة</label>
                                <select name="city" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 focus:ring-luxury-wood focus:border-luxury-wood">
                                    <option value="">اختر المدينة</option>
                                    <option value="الرياض">الرياض</option>
                                    <option value="جدة">جدة</option>
                                    <option value="الدمام">الدمام</option>
                                    <option value="مكة">مكة</option>
                                </select>
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="block font-bold">العنوان التفصيلي</label>
                                <input type="text" name="address" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 focus:ring-luxury-wood focus:border-luxury-wood" placeholder="اسم الحي - اسم الشارع - رقم المبنى">
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="block font-bold">ملاحظات إضافية (اختياري)</label>
                                <textarea name="notes" rows="3" class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 focus:ring-luxury-wood focus:border-luxury-wood" placeholder="أي تعليمات خاصة بالتوصيل"></textarea>
                            </div>
                        </div>

                        <div class="mt-12">
                            <h2 class="text-xl font-bold mb-6 flex items-center justify-end gap-3 border-t pt-8">
                                طريقة الدفع
                                <svg class="w-6 h-6 text-luxury-wood" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            </h2>
                            <div class="bg-luxury-wood/5 border-2 border-luxury-wood p-6 rounded-2xl flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-luxury-wood flex items-center justify-center">
                                        <div class="w-2 h-2 rounded-full bg-white"></div>
                                    </div>
                                    <span class="font-bold">الدفع عند الاستلام</span>
                                </div>
                                <svg class="w-8 h-8 text-luxury-wood" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>

                        <!-- Captcha Section -->
                        <div class="mt-8 pt-8 border-t">
                            @include('components.captcha')
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm text-right sticky top-28">
                        <h2 class="text-xl font-bold mb-6 border-b pb-4">مراجعة الطلب</h2>
                        <div class="space-y-4 mb-8 max-h-60 overflow-y-auto">
                            @foreach($cart as $id => $details)
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-gray-50 flex-shrink-0 overflow-hidden">
                                    <img src="{{ $details['image'] ? asset('storage/'.$details['image']) : 'https://via.placeholder.com/100x100.png?text=Product' }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <div class="font-bold text-sm">{{ $details['name'] }}</div>
                                    <div class="text-xs text-gray-500">الكمية: {{ $details['quantity'] }}</div>
                                </div>
                                <div class="font-bold text-sm">{{ number_format($details['price'] * $details['quantity'], 2) }} {{ \App\Models\Setting::get('store_currency', 'د.م.') }}</div>
                            </div>
                            @endforeach
                        </div>
                        <div class="space-y-3 mb-8 border-t pt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">المجموع</span>
                                <span>{{ number_format($total, 2) }} {{ \App\Models\Setting::get('store_currency', 'د.م.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">الشحن</span>
                                <span class="text-green-500">مجاني</span>
                            </div>
                            <div class="flex justify-between text-xl font-bold pt-2">
                                <span>الإجمالي</span>
                                <span class="text-luxury-wood">{{ number_format($total, 2) }} {{ \App\Models\Setting::get('store_currency', 'د.م.') }}</span>
                            </div>
                        </div>
                        <button type="submit" class="block w-full bg-luxury-black text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-black transition shadow-lg">تأكيد الطلب الآن</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

