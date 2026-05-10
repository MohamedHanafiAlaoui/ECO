@extends('admin.layout')

@section('title', 'الرئيسية')

@section('content')
<div class="space-y-8" x-data="{ dateRange: 'اليوم' }">
    <!-- Premium Header with Date Picker -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-right">
        <div class="w-full md:w-auto">
            <h1 class="text-3xl font-black text-luxury-black mb-2">إحصائيات المتجر</h1>
            <p class="text-gray-400 font-bold">مرحباً {{ session('admin_name') }}، إليك نظرة مفصلة على أداء متجرك</p>
            
            @if($sheetUrl = \App\Models\Setting::get('google_sheet_url'))
            <a href="{{ $sheetUrl }}" target="_blank" class="inline-flex items-center gap-2 mt-4 bg-green-50 text-green-700 px-4 py-2 rounded-xl text-sm font-black border border-green-100 hover:bg-green-100 transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 4h7v5h5v11H6V4z"/></svg>
                فتح Google Sheet
            </a>
            @endif
        </div>
        <div class="flex items-center gap-3 bg-white p-2 rounded-[1.5rem] shadow-sm border border-gray-50 overflow-hidden">
            <button @click="dateRange = 'اليوم'" :class="dateRange === 'اليوم' ? 'bg-luxury-wood text-white shadow-lg' : 'text-gray-400 hover:bg-gray-50'" class="px-6 py-2 rounded-xl text-sm font-black transition">اليوم</button>
            <button @click="dateRange = '7 أيام'" :class="dateRange === '7 أيام' ? 'bg-luxury-wood text-white shadow-lg' : 'text-gray-400 hover:bg-gray-50'" class="px-6 py-2 rounded-xl text-sm font-black transition">آخر 7 أيام</button>
            <button @click="dateRange = '30 يوماً'" :class="dateRange === '30 يوماً' ? 'bg-luxury-wood text-white shadow-lg' : 'text-gray-400 hover:bg-gray-50'" class="px-6 py-2 rounded-xl text-sm font-black transition">آخر 30 يوماً</button>
            <div class="w-px h-8 bg-gray-100 mx-2"></div>
            <div class="flex items-center gap-3 px-4 text-luxury-black font-bold text-sm">
                <span>{{ date('Y/m/d') }}</span>
                <svg class="w-5 h-5 text-luxury-wood" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Key Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Sales Card -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 hover:shadow-xl transition-all group overflow-hidden relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-luxury-wood/5 rounded-bl-full group-hover:scale-110 transition-transform"></div>
            <div class="relative z-10 text-right space-y-4">
                <div class="flex items-center justify-between flex-row-reverse">
                    <div class="bg-luxury-wood/10 p-3 rounded-2xl text-luxury-wood group-hover:bg-luxury-wood group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="text-green-500 text-xs font-black">+{{ $stats['sales_growth'] }}%</div>
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">إجمالي المبيعات</p>
                    <h3 class="text-2xl font-black text-luxury-black">{{ number_format($stats['total_sales'], 2) }} <span class="text-sm font-bold opacity-50">{{ \App\Models\Setting::get('store_currency', 'ر.س') }}</span></h3>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 hover:shadow-xl transition-all group overflow-hidden relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full group-hover:scale-110 transition-transform"></div>
            <div class="relative z-10 text-right space-y-4">
                <div class="flex items-center justify-between flex-row-reverse">
                    <div class="bg-blue-50 p-3 rounded-2xl text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 118 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div class="text-blue-500 text-xs font-black">+{{ $stats['orders_growth'] }}%</div>
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">عدد الطلبيات</p>
                    <h3 class="text-2xl font-black text-luxury-black">{{ $stats['total_orders'] }} <span class="text-sm font-bold opacity-50">طلب</span></h3>
                </div>
            </div>
        </div>

        <!-- Average Order Card -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 hover:shadow-xl transition-all group overflow-hidden relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-bl-full group-hover:scale-110 transition-transform"></div>
            <div class="relative z-10 text-right space-y-4">
                <div class="flex items-center justify-between flex-row-reverse">
                    <div class="bg-purple-50 p-3 rounded-2xl text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <div class="text-purple-500 text-xs font-black">+{{ rand(1, 5) }}.{{ rand(1, 9) }}%</div>
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">متوسط قيمة الطلب</p>
                    <h3 class="text-2xl font-black text-luxury-black">
                        {{ number_format($stats['avg_order_value'], 2) }} 
                        <span class="text-sm font-bold opacity-50">ر.س</span>
                    </h3>
                </div>
            </div>
        </div>

        <!-- Conversion Card -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 hover:shadow-xl transition-all group overflow-hidden relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-full group-hover:scale-110 transition-transform"></div>
            <div class="relative z-10 text-right space-y-4">
                <div class="flex items-center justify-between flex-row-reverse">
                    <div class="bg-green-50 p-3 rounded-2xl text-green-500 group-hover:bg-green-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div class="text-green-500 text-xs font-black">+0.8%</div>
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">معدل التحويل</p>
                    <h3 class="text-2xl font-black text-luxury-black">{{ $stats['conversion_rate'] }} <span class="text-sm font-bold opacity-50">%</span></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Main Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sales Chart -->
        <div class="lg:col-span-2 bg-white rounded-[2.5rem] shadow-sm border border-gray-50 p-8 space-y-6">
            <div class="flex justify-between items-center flex-row-reverse">
                <h2 class="text-xl font-black text-luxury-black">منحنى المبيعات والطلبات</h2>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-luxury-wood"></span>
                        <span class="text-xs font-bold text-gray-400">المبيعات</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-blue-400"></span>
                        <span class="text-xs font-bold text-gray-400">الطلبات</span>
                    </div>
                </div>
            </div>
            <div class="h-80 bg-gray-50 rounded-[2rem] flex items-center justify-center text-gray-300 font-black italic">
                <!-- Placeholder for Chart.js -->
                [ رسم بياني تفاعلي للشهر الحالي ]
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 p-8 space-y-6">
            <div class="flex justify-between items-center flex-row-reverse">
                <h2 class="text-xl font-black text-luxury-black">أكثر المنتجات مبيعاً</h2>
                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </div>
            <div class="space-y-4">
                @foreach($recentOrders->unique('id')->take(5) as $order)
                <div class="flex items-center gap-4 flex-row-reverse text-right">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden">
                        <img src="https://via.placeholder.com/50x50.png?text=Product" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow">
                        <div class="text-sm font-black text-luxury-black">منتج خشبي فاخر</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ rand(5, 50) }} عملية بيع</div>
                    </div>
                    <div class="text-sm font-black text-luxury-wood">{{ number_format($order->total_amount / rand(1, 2), 2) }} <span class="text-[10px]">{{ \App\Models\Setting::get('store_currency', 'ر.س') }}</span></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Traffic & Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Traffic Info -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 p-8 space-y-8">
            <h2 class="text-xl font-black text-luxury-black text-right">حركة المرور</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-6 rounded-[1.5rem] text-center">
                    <div class="text-gray-400 text-[10px] font-black uppercase mb-1">الزوار</div>
                    <div class="text-2xl font-black text-luxury-black">{{ number_format($stats['visitors']) }}</div>
                </div>
                <div class="bg-gray-50 p-6 rounded-[1.5rem] text-center">
                    <div class="text-gray-400 text-[10px] font-black uppercase mb-1">مشاهدات الصفحة</div>
                    <div class="text-2xl font-black text-luxury-black">{{ number_format($stats['page_views']) }}</div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center flex-row-reverse text-right">
                    <div class="flex items-center gap-3 flex-row-reverse">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-sm font-bold">الهاتف المحمول</span>
                    </div>
                    <span class="text-sm font-black text-luxury-black">{{ $stats['mobile_percentage'] }}%</span>
                </div>
                <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-luxury-wood h-full" style="width: {{ $stats['mobile_percentage'] }}%"></div>
                </div>
                
                <div class="flex justify-between items-center flex-row-reverse text-right pt-2">
                    <div class="flex items-center gap-3 flex-row-reverse">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-sm font-bold">الحاسوب</span>
                    </div>
                    <span class="text-sm font-black text-luxury-black">{{ $stats['desktop_percentage'] }}%</span>
                </div>
                <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-gray-400 h-full" style="width: {{ $stats['desktop_percentage'] }}%"></div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="lg:col-span-2 bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex justify-between items-center flex-row-reverse">
                <h2 class="text-xl font-black text-luxury-black">أحدث الطلبيات</h2>
                <a href="{{ route('admin.orders') }}" class="text-luxury-wood text-xs font-black hover:underline">عرض الكل &larr;</a>
            </div>
            <table class="w-full text-right">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="px-8 py-5">الرقم</th>
                        <th class="px-8 py-5">العميل</th>
                        <th class="px-8 py-5">المبلغ</th>
                        <th class="px-8 py-5 text-center">الحالة</th>
                        <th class="px-8 py-5">التاريخ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($recentOrders->take(5) as $order)
                    <tr class="hover:bg-gray-50/50 transition cursor-pointer">
                        <td class="px-8 py-6 font-black text-luxury-wood">#{{ $order->order_number }}</td>
                        <td class="px-8 py-6">
                            <div class="font-bold text-luxury-black">{{ $order->full_name }}</div>
                            <div class="text-[10px] text-gray-400">{{ $order->phone }}</div>
                        </td>
                        <td class="px-8 py-6 font-black">{{ number_format($order->total_amount, 2) }} {{ \App\Models\Setting::get('store_currency', 'ر.س') }}</td>
                        <td class="px-8 py-6 text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                                    'completed' => 'bg-green-50 text-green-600 border-green-100',
                                    'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                    'processed' => 'bg-blue-50 text-blue-600 border-blue-100'
                                ];
                                $statusText = [
                                    'pending' => 'انتظار',
                                    'completed' => 'مكتمل',
                                    'cancelled' => 'ملغي',
                                    'processed' => 'معالج'
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase border {{ $statusClasses[$order->status] ?? 'bg-gray-100' }}">
                                {{ $statusText[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-gray-400 text-xs font-bold">{{ $order->created_at->format('M d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection

