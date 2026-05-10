@extends('admin.layout')

@section('title', 'إدارة الأقسام')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6 text-right">
        <h1 class="text-3xl font-black text-luxury-black">الأقسام</h1>
        <div class="text-gray-400 text-sm font-bold">تنظيم منتجات متجرك في مجموعات</div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Add Category Form -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[2.5rem] shadow-sm p-10 text-right border border-gray-50">
                <div class="flex items-center justify-end gap-3 mb-8">
                    <h2 class="text-xl font-black text-luxury-black">إضافة قسم جديد</h2>
                    <div class="bg-luxury-wood/10 p-2 rounded-lg text-luxury-wood">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                </div>
                
                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">اسم القسم</label>
                        <input type="text" name="name" required 
                               class="w-full bg-gray-50 border-none rounded-2xl p-4 text-lg font-bold focus:ring-2 focus:ring-luxury-wood/20 shadow-inner" 
                               placeholder="مثال: منظمات خشبية">
                    </div>
                    
                    <div class="p-4 bg-yellow-50 rounded-2xl border border-yellow-100 flex gap-3 flex-row-reverse text-right">
                        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-[10px] text-yellow-700 font-bold leading-relaxed">سيتم إنشاء رابط القسم (Slug) تلقائياً بناءً على الاسم الذي تدخله.</p>
                    </div>

                    <button type="submit" class="w-full bg-luxury-wood text-white py-4 rounded-2xl font-black hover:bg-[#6b4423] transition shadow-xl text-lg">
                        حفظ القسم الجديد
                    </button>
                </form>
            </div>
        </div>

        <!-- Categories List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center flex-row-reverse">
                    <h2 class="text-xl font-black text-luxury-black">قائمة الأقسام المسجلة</h2>
                    <span class="bg-gray-100 text-gray-500 px-4 py-1 rounded-full text-[10px] font-black uppercase">{{ $categories->count() }} أقسام</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        <thead>
                            <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                                <th class="px-10 py-5">الاسم</th>
                                <th class="px-10 py-5 text-center">عدد المنتجات</th>
                                <th class="px-10 py-5 text-center">الحالة</th>
                                <th class="px-10 py-5">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($categories as $category)
                            <tr class="hover:bg-gray-50/30 transition group">
                                <td class="px-10 py-6">
                                    <div class="font-black text-luxury-black text-lg">{{ $category->name }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Slug: /category/{{ $category->slug }}</div>
                                </td>
                                <td class="px-10 py-6 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="font-black text-luxury-wood text-xl">{{ $category->products_count }}</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase">منتجات مرتبطة</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase bg-green-50 text-green-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600 ml-2"></span>
                                        نشط
                                    </span>
                                </td>
                                <td class="px-10 py-6">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition">
                                        <a href="{{ route('admin.categories.delete', $category->id) }}" 
                                           onclick="return confirm('حذف القسم سيؤدي لحذف كافة المنتجات التابعة له، هل أنت متأكد؟')" 
                                           class="p-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

