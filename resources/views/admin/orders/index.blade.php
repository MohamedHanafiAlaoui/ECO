@extends('admin.layout')

@section('title', 'إدارة الطلبيات')

@section('content')
<div class="space-y-6" x-data="{ exportModal: false, massModal: false, selectedOrders: [] }">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6 text-right">
        <h1 class="text-3xl font-black text-luxury-black">الطلبيات</h1>
        <div class="flex gap-3">
            <button @click="massModal = true" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                إجراءات جماعية
            </button>
            <button @click="exportModal = true" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                تصدير
            </button>
        </div>
    </div>

    <!-- Enhanced Filters Bar -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-2">
        <form action="{{ route('admin.orders') }}" method="GET" class="flex flex-col lg:flex-row-reverse gap-2 items-stretch lg:items-center">
            <!-- Main Search -->
            <div class="flex-grow relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="البحث عن الطلبيات (رقم الطلب، اسم العميل...)" 
                       class="w-full bg-transparent border-none rounded-2xl py-4 pr-12 pl-4 text-sm focus:ring-0 text-right font-medium" 
                       style="direction: rtl;">
                <svg class="w-5 h-5 absolute top-4 right-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>

            <!-- Vertical Divider -->
            <div class="hidden lg:block w-px h-8 bg-gray-100"></div>

            <!-- Status Filter -->
            <div class="min-w-[160px]">
                <select name="status" class="w-full bg-transparent border-none py-4 px-4 text-sm font-bold text-gray-600 focus:ring-0 text-right cursor-pointer" style="direction: rtl;">
                    <option value="">تأكيد الحالة</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>مفتوحة</option>
                    <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>معالجة</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مغلقة</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغاة</option>
                </select>
            </div>

            <!-- Payment Filter -->
            <div class="min-w-[160px]">
                <select name="payment" class="w-full bg-transparent border-none py-4 px-4 text-sm font-bold text-gray-600 focus:ring-0 text-right cursor-pointer" style="direction: rtl;">
                    <option value="">حالة الدفع</option>
                    <option value="paid" {{ request('payment') == 'paid' ? 'selected' : '' }}>مدفوعة</option>
                    <option value="unpaid" {{ request('payment') == 'unpaid' ? 'selected' : '' }}>غير مدفوعة</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="px-2">
                <button type="submit" class="bg-luxury-wood text-white px-8 py-3 rounded-2xl font-black hover:bg-[#6b4423] transition shadow-md">
                    تصفية
                </button>
            </div>
        </form>
    </div>

    <!-- Orders Table Container -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="px-6 py-4 w-10 text-center">
                            <input type="checkbox" @change="selectedOrders = $event.target.checked ? {{ json_encode($orders->pluck('id')) }} : []" class="rounded border-gray-300 text-luxury-wood focus:ring-luxury-wood">
                        </th>
                        <th class="px-6 py-4">المرجع</th>
                        <th class="px-6 py-4">العميل</th>
                        <th class="px-6 py-4 text-center">الحالة</th>
                        <th class="px-6 py-4 text-center">الدفع</th>
                        <th class="px-6 py-4 text-center">الشحن</th>
                        <th class="px-6 py-4 text-left">المجموع</th>
                        <th class="px-6 py-4 text-center">التاريخ</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/30 transition group">
                        <td class="px-6 py-5 text-center">
                            <input type="checkbox" :value="{{ $order->id }}" x-model="selectedOrders" class="rounded border-gray-300 text-luxury-wood focus:ring-luxury-wood">
                        </td>
                        <td class="px-6 py-5">
                            <span class="font-black text-luxury-black">#{{ $order->order_number }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900">{{ $order->full_name }}</span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">{{ $order->city }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex justify-center">
                                @csrf
                                <select name="status" onchange="this.form.submit()" 
                                        class="bg-gray-100/50 border-none rounded-xl text-[10px] font-black px-4 py-1.5 focus:ring-0 cursor-pointer hover:bg-gray-200 transition" 
                                        style="direction: rtl;">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>مفتوحة</option>
                                    <option value="processed" {{ $order->status === 'processed' ? 'selected' : '' }}>معالجة</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>مغلقة</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>ملغاة</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-5">
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex justify-center">
                                @csrf
                                <select name="payment_status" onchange="this.form.submit()" 
                                        class="bg-gray-100/50 border-none rounded-xl text-[10px] font-black px-4 py-1.5 focus:ring-0 cursor-pointer hover:bg-gray-200 transition"
                                        style="direction: rtl;">
                                    <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>غير مدفوعة</option>
                                    <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>مدفوعة</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-5">
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex justify-center">
                                @csrf
                                <select name="shipping_status" onchange="this.form.submit()" 
                                        class="bg-gray-100/50 border-none rounded-xl text-[10px] font-black px-4 py-1.5 focus:ring-0 cursor-pointer hover:bg-gray-200 transition"
                                        style="direction: rtl;">
                                    <option value="unfulfilled" {{ $order->shipping_status === 'unfulfilled' ? 'selected' : '' }}>بانتظار الشحن</option>
                                    <option value="processing" {{ $order->shipping_status === 'processing' ? 'selected' : '' }}>قيد التجهيز</option>
                                    <option value="shipped" {{ $order->shipping_status === 'shipped' ? 'selected' : '' }}>تم الشحن</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-5 text-left">
                            <span class="font-black text-luxury-black text-sm">{{ number_format($order->total_amount, 2) }} <span class="text-[10px] text-gray-400">{{ \App\Models\Setting::get('store_currency', 'ر.س') }}</span></span>
                        </td>
                        <td class="px-6 py-5 text-center text-[10px] text-gray-400 font-bold">
                            {{ $order->created_at->format('Y/m/d') }}<br>{{ $order->created_at->format('H:i') }}
                        </td>
                        <td class="px-6 py-5 text-left">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="#" class="p-2 bg-luxury-wood/5 text-luxury-wood rounded-lg hover:bg-luxury-wood hover:text-white transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->phone) }}" target="_blank" class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition shadow-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-4 text-gray-300">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <span class="text-sm font-bold">لا يوجد طلبيات حالياً</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="p-6 border-t border-gray-50 flex justify-center bg-gray-50/30">
            {{ $orders->links() }}
        </div>
        @endif
    </div>

    <!-- Modals (Export & Mass Operations) -->
    <!-- Export Modal -->
    <div x-show="exportModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>
        <div @click="exportModal = false" class="absolute inset-0 bg-luxury-black/40 backdrop-blur-md transition-opacity"></div>
        <div class="bg-white rounded-[2.5rem] w-full max-w-lg relative z-10 p-10 shadow-2xl transform transition-all">
            <div class="flex justify-between items-center mb-8 flex-row-reverse">
                <h2 class="text-2xl font-black text-luxury-black">تصدير البيانات</h2>
                <button @click="exportModal = false" class="text-gray-300 hover:text-gray-500 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="space-y-6 text-right">
                <div class="p-6 bg-gray-50 rounded-3xl border border-gray-100">
                    <label class="block text-xs font-black text-gray-400 mb-3 uppercase tracking-wider">تنسيق الملف</label>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="bg-white border-2 border-luxury-wood text-luxury-wood py-4 rounded-2xl font-black shadow-sm">Excel (.xlsx)</button>
                        <button class="bg-white border-2 border-gray-100 text-gray-400 py-4 rounded-2xl font-black hover:border-luxury-wood transition">CSV (.csv)</button>
                    </div>
                </div>
                <div class="flex gap-4 pt-4">
                    <button class="flex-1 bg-luxury-black text-white py-5 rounded-[1.5rem] font-black hover:bg-gray-800 transition shadow-xl">تحميل الملف</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mass Operations Modal -->
    <div x-show="massModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>
        <div @click="massModal = false" class="absolute inset-0 bg-luxury-black/40 backdrop-blur-md transition-opacity"></div>
        <div class="bg-white rounded-[2.5rem] w-full max-w-lg relative z-10 p-10 shadow-2xl transform transition-all">
            <div class="flex justify-between items-center mb-8 flex-row-reverse">
                <h2 class="text-2xl font-black text-luxury-black">إجراءات جماعية</h2>
                <button @click="massModal = false" class="text-gray-300 hover:text-gray-500 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="space-y-6 text-right">
                <p class="text-gray-400 text-sm font-medium">سيتم تطبيق التعديلات على <span class="text-luxury-wood font-black" x-text="selectedOrders.length">0</span> طلبية مختارة</p>
                
                <div class="grid grid-cols-1 gap-3">
                    <button class="w-full bg-green-50 text-green-600 py-4 rounded-2xl font-black hover:bg-green-600 hover:text-white transition text-right px-6 flex items-center justify-between flex-row-reverse">
                        <span>تحديد كـ "مكتملة"</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                    <button class="w-full bg-blue-50 text-blue-600 py-4 rounded-2xl font-black hover:bg-blue-600 hover:text-white transition text-right px-6 flex items-center justify-between flex-row-reverse">
                        <span>تحديد كـ "تم الشحن"</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </button>
                    <button class="w-full bg-red-50 text-red-600 py-4 rounded-2xl font-black hover:bg-red-600 hover:text-white transition text-right px-6 flex items-center justify-between flex-row-reverse">
                        <span>إلغاء الطلبيات</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    input[type="checkbox"]:checked {
        background-color: #8B5E3C;
        border-color: #8B5E3C;
    }
</style>
@endsection

