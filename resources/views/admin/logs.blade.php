@extends('admin.layout')

@section('title', 'سجل النشاطات')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center mb-6 text-right">
        <h1 class="text-3xl font-black text-luxury-black">سجل النشاطات</h1>
        <div class="text-gray-400 text-sm font-bold">مراقبة الأمان والعمليات في متجرك</div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">التاريخ</th>
                        <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">المشرف</th>
                        <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">العملية</th>
                        <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">الوصف</th>
                        <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($logs as $log)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $log->created_at->format('Y-m-d') }}</div>
                            <div class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center gap-3 flex-row-reverse">
                                <div class="w-8 h-8 rounded-full bg-luxury-wood/10 text-luxury-wood flex items-center justify-center font-black text-xs">
                                    {{ substr($log->admin->name ?? 'S', 0, 1) }}
                                </div>
                                <span class="text-sm font-bold">{{ $log->admin->name ?? 'النظام' }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            @php
                                $badgeColor = match($log->action) {
                                    'login' => 'bg-green-50 text-green-600',
                                    'failed_login' => 'bg-red-50 text-red-600',
                                    'logout' => 'bg-gray-50 text-gray-600',
                                    'product_create', 'product_update', 'product_delete' => 'bg-blue-50 text-blue-600',
                                    default => 'bg-luxury-wood/5 text-luxury-wood',
                                };
                            @endphp
                            <span class="{{ $badgeColor }} px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm text-gray-600 font-medium">{{ $log->description }}</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="font-mono text-xs text-gray-400">{{ $log->ip_address }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <p class="text-gray-400 font-bold italic">لا توجد سجلات حالياً</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($logs->hasPages())
        <div class="p-8 border-t border-gray-50">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

