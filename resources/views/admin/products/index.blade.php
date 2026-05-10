@extends('admin.layout')

@section('title', 'إدارة المنتجات')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6 text-right">
        <h1 class="text-3xl font-black text-luxury-black">المنتجات</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.products.create') }}" class="bg-luxury-wood text-white px-8 py-3 rounded-2xl font-black hover:bg-[#6b4423] transition shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                إضافة منتج جديد
            </a>
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="px-8 py-5">المنتج</th>
                        <th class="px-8 py-5 text-center">القسم</th>
                        <th class="px-8 py-5 text-center">السعر</th>
                        <th class="px-8 py-5 text-center">المخزون</th>
                        <th class="px-8 py-5 text-center">الحالة</th>
                        <th class="px-8 py-5 text-left">إجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/30 transition group">
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-end gap-5">
                                <div class="text-right">
                                    <div class="font-black text-luxury-black text-lg">{{ $product->name }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">SKU: {{ $product->sku ?? '---' }}</div>
                                </div>
                                <div class="w-16 h-16 rounded-2xl bg-gray-100 overflow-hidden border border-gray-100 shadow-sm flex-shrink-0">
                                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200x200.png?text=Product' }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="bg-luxury-wood/5 text-luxury-wood px-4 py-1.5 rounded-xl text-[10px] font-black uppercase">
                                {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex flex-col">
                                <span class="font-black text-luxury-black">{{ number_format($product->price, 2) }} {{ \App\Models\Setting::get('store_currency', 'ر.س') }}</span>
                                @if($product->compare_at_price)
                                <span class="text-[10px] text-gray-300 line-through font-bold">{{ number_format($product->compare_at_price, 2) }} {{ \App\Models\Setting::get('store_currency', 'ر.س') }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex flex-col items-center">
                                <span class="font-black {{ $product->stock <= 5 ? 'text-red-500' : 'text-gray-700' }}">{{ $product->stock }}</span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase">قطعة متوفرة</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $product->is_active ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $product->is_active ? 'bg-green-600' : 'bg-red-600' }} ml-2"></span>
                                {{ $product->is_active ? 'نشط' : 'غير نشط' }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="p-3 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <a href="{{ route('admin.products.delete', $product->id) }}" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')" class="p-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center gap-4 text-gray-300">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                <span class="text-sm font-bold">لم تقم بإضافة أي منتجات بعد</span>
                                <a href="{{ route('admin.products.create') }}" class="text-luxury-wood hover:underline font-bold">ابدأ بإضافة أول منتج الآن</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
        <div class="p-8 border-t border-gray-50 flex justify-center bg-gray-50/30">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

