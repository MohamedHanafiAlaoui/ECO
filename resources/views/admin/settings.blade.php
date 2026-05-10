@extends('admin.layout')

@section('title', 'إعدادات المتجر')

@section('content')
<div class="space-y-6" x-data="{ activeTab: 'online' }">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6 text-right">
        <h1 class="text-3xl font-black text-luxury-black">الإعدادات</h1>
        <div class="text-gray-400 text-sm font-bold">تخصيص وتحكم في إعدادات متجرك</div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Settings Sidebar -->
        <div class="w-full lg:w-72 flex-shrink-0">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-50 overflow-hidden">
                <nav class="p-4 space-y-2">
                    <button @click="activeTab = 'account'" :class="activeTab === 'account' ? 'bg-luxury-wood text-white shadow-lg' : 'text-gray-500 hover:bg-gray-50'" class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition text-right justify-between flex-row-reverse">
                        <div class="flex items-center gap-4 flex-row-reverse">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>الحساب</span>
                        </div>
                    </button>
                    <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'bg-luxury-wood text-white shadow-lg' : 'text-gray-500 hover:bg-gray-50'" class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition text-right justify-between flex-row-reverse">
                        <div class="flex items-center gap-4 flex-row-reverse">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>عام</span>
                        </div>
                    </button>
                    <button @click="activeTab = 'online'" :class="activeTab === 'online' ? 'bg-luxury-wood text-white shadow-lg' : 'text-gray-500 hover:bg-gray-50'" class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition text-right justify-between flex-row-reverse">
                        <div class="flex items-center gap-4 flex-row-reverse">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            <span>أونلاين</span>
                        </div>
                    </button>
                    <button @click="activeTab = 'payment'" :class="activeTab === 'payment' ? 'bg-luxury-wood text-white shadow-lg' : 'text-gray-500 hover:bg-gray-50'" class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition text-right justify-between flex-row-reverse">
                        <div class="flex items-center gap-4 flex-row-reverse">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span>الدفع</span>
                        </div>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="flex-grow">
            <!-- Success Message Alert -->
            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-100 text-green-600 px-8 py-4 rounded-3xl font-black flex items-center justify-between flex-row-reverse animate-bounce">
                <div class="flex items-center gap-4 flex-row-reverse">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="$el.parentElement.remove()" class="hover:opacity-70 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            @endif

            <!-- Online Settings (Detailed according to request) -->
            <div x-show="activeTab === 'online'" class="space-y-8" x-cloak>
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
                        <div class="p-8 border-b border-gray-100 flex justify-between items-center flex-row-reverse">
                            <div class="flex items-center gap-4 flex-row-reverse">
                                <div class="bg-luxury-wood/10 p-3 rounded-2xl text-luxury-wood">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </div>
                                <h2 class="text-xl font-black text-luxury-black">تكوينات CSS/JavaScript</h2>
                            </div>
                        </div>

                        <div class="p-10 space-y-8 text-right">
                            <!-- Info Box -->
                            <div class="bg-blue-50 border border-blue-100 rounded-[1.5rem] p-6 flex gap-4 flex-row-reverse items-center">
                                <div class="bg-blue-500 text-white p-2 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-sm text-blue-800 font-bold">ملاحظة: لا تنس تأطير الرمز المخصّص الخاص بك بالعلامات المطلوبة مثل &lt;style&gt; أو &lt;script&gt;</p>
                            </div>

                            <!-- Editor Fields -->
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">رمز العنوان الإضافي (Header Code)</label>
                                    <div class="bg-gray-900 rounded-2xl p-4 min-h-[200px] shadow-inner font-mono text-sm text-white/80">
                                        <textarea name="header_code" class="w-full bg-transparent border-none focus:ring-0 resize-none min-h-[180px] p-0" spellcheck="false" placeholder="<!-- أدخل الكود هنا -->">{{ $settings['header_code'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">الرمز التذييل الإضافي (Footer Code)</label>
                                    <div class="bg-gray-900 rounded-2xl p-4 min-h-[150px] shadow-inner font-mono text-sm text-white/80">
                                        <textarea name="footer_code" class="w-full bg-transparent border-none focus:ring-0 resize-none min-h-[130px] p-0" spellcheck="false" placeholder="<!-- أدخل الكود هنا -->">{{ $settings['footer_code'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">معرف فيسبوك بيكسل (Facebook Pixel ID)</label>
                                    <input type="text" name="facebook_pixel_id" value="{{ $settings['facebook_pixel_id'] ?? '' }}" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20" placeholder="مثلاً: 1234567890">
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">رابط Google Sheet (لإدارة الطلبات)</label>
                                    <input type="url" name="google_sheet_url" value="{{ $settings['google_sheet_url'] ?? '' }}" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20" placeholder="https://docs.google.com/spreadsheets/d/...">
                                </div>

                            <!-- Action Bar -->
                            <div class="pt-6 border-t border-gray-100 flex justify-end">
                                <button type="submit" class="bg-luxury-wood text-white px-10 py-4 rounded-2xl font-black shadow-xl hover:bg-[#6b4423] transition flex items-center gap-3">
                                    <span>حفظ التعديلات</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- General Settings -->
            <div x-show="activeTab === 'general'" class="space-y-8" x-cloak>
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <!-- Store Details -->
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
                        <div class="p-8 border-b border-gray-100 flex justify-between items-center flex-row-reverse">
                            <h2 class="text-xl font-black text-luxury-black">التفاصيل الأساسية</h2>
                        </div>
                        <div class="p-10 space-y-6 text-right">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">اسم المتجر</label>
                                    <input type="text" name="store_name" value="{{ $settings['store_name'] ?? 'متجر المنظمات الخشبية' }}" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">عنوان المتجر (SEO Title)</label>
                                    <input type="text" name="store_title" value="{{ $settings['store_title'] ?? 'أفخم المنظمات الخشبية في الخليج' }}" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">بريد المتجر</label>
                                    <input type="email" name="store_email" value="{{ $settings['store_email'] ?? 'contact@luxurywood.com' }}" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">رقم الهاتف (للاتصال)</label>
                                    <input type="text" name="store_phone" value="{{ $settings['store_phone'] ?? '+212 600 000 000' }}" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20" placeholder="+212 600 000 000">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">رقم الواتساب (بدون +)</label>
                                    <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '212600000000' }}" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20" placeholder="212600000000">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">لغة المتجر</label>
                                    <select name="store_language" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                                        <option value="ar" {{ ($settings['store_language'] ?? 'ar') == 'ar' ? 'selected' : '' }}>العربية (السعودية)</option>
                                        <option value="en" {{ ($settings['store_language'] ?? '') == 'en' ? 'selected' : '' }}>English</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">عملة المتجر</label>
                                    <select name="store_currency" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                                        <option value="MAD" {{ ($settings['store_currency'] ?? '') == 'MAD' ? 'selected' : '' }}>الدرهم المغربي (د.م.)</option>
                                        <option value="SAR" {{ ($settings['store_currency'] ?? 'SAR') == 'SAR' ? 'selected' : '' }}>ريال سعودي (ر.س)</option>
                                        <option value="AED" {{ ($settings['store_currency'] ?? '') == 'AED' ? 'selected' : '' }}>درهم إماراتي</option>
                                        <option value="USD" {{ ($settings['store_currency'] ?? '') == 'USD' ? 'selected' : '' }}>دولار أمريكي</option>
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">وصف المتجر</label>
                                <textarea name="store_description" rows="3" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20" placeholder="وصف قصير يظهر في محركات البحث...">{{ $settings['store_description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Order Settings -->
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
                        <div class="p-8 border-b border-gray-100 flex justify-between items-center flex-row-reverse">
                            <h2 class="text-xl font-black text-luxury-black">إعدادات الطلبيات</h2>
                        </div>
                        <div class="p-10 text-right">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">بادئة الطلبية (Prefix)</label>
                                    <input type="text" name="order_prefix" value="{{ $settings['order_prefix'] ?? 'ORD-' }}" placeholder="مثلاً: ORD-" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">المبلغ الأقصى للدفع</label>
                                    <input type="number" name="max_order_value" value="{{ $settings['max_order_value'] ?? '0' }}" placeholder="0" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">ضريبة القيمة المضافة (%)</label>
                                    <input type="number" step="0.01" name="vat_percentage" value="{{ $settings['vat_percentage'] ?? '15' }}" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Brand Identity -->
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
                        <div class="p-8 border-b border-gray-100 flex justify-between items-center flex-row-reverse">
                            <h2 class="text-xl font-black text-luxury-black">الشعار والأيقونة</h2>
                        </div>
                        <div class="p-10 text-right">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <!-- Logo -->
                                <div class="space-y-4">
                                    <div class="bg-blue-50 text-blue-700 p-4 rounded-2xl text-[10px] font-black uppercase text-center border border-blue-100">الحجم الموصى به: 450 × 100</div>
                                    <div class="relative border-2 border-dashed border-gray-100 rounded-3xl p-8 flex flex-col items-center justify-center bg-gray-50/50 hover:bg-gray-50 transition cursor-pointer group">
                                        @if($logo = \App\Models\Setting::get('store_logo'))
                                            <img src="{{ asset('storage/' . $logo) }}" class="max-h-20 mb-4 rounded-lg shadow-sm">
                                        @else
                                            <svg class="w-12 h-12 text-gray-200 group-hover:text-luxury-wood transition mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                        <span class="text-sm font-bold text-gray-400">اختر شعار المتجر</span>
                                        <input type="file" name="store_logo" class="absolute inset-0 opacity-0 cursor-pointer">
                                    </div>
                                </div>
                                <!-- Favicon -->
                                <div class="space-y-4">
                                    <div class="bg-blue-50 text-blue-700 p-4 rounded-2xl text-[10px] font-black uppercase text-center border border-blue-100">الحجم الموصى به: 32 × 32</div>
                                    <div class="relative border-2 border-dashed border-gray-100 rounded-3xl p-8 flex flex-col items-center justify-center bg-gray-50/50 hover:bg-gray-50 transition cursor-pointer group">
                                        @if($favicon = \App\Models\Setting::get('store_favicon'))
                                            <img src="{{ asset('storage/' . $favicon) }}" class="w-12 h-12 mb-4 rounded shadow-sm">
                                        @else
                                            <svg class="w-12 h-12 text-gray-200 group-hover:text-luxury-wood transition mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                        <span class="text-sm font-bold text-gray-400">اختر أيقونة الموقع</span>
                                        <input type="file" name="store_favicon" class="absolute inset-0 opacity-0 cursor-pointer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-luxury-wood text-white px-12 py-5 rounded-[2rem] font-black shadow-2xl hover:bg-[#6b4423] transition-all transform hover:scale-105 flex items-center gap-4">
                            <span>حفظ كافة الإعدادات العامة</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .dir-ltr { direction: ltr; }
    [x-cloak] { display: none !important; }
</style>
@endsection

