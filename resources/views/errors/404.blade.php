@extends('layouts.app')

@section('title', '404 - الصفحة غير موجودة')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center bg-luxury-beige dark:bg-gray-900 px-4">
    <div class="text-center" data-aos="zoom-in">
        <h1 class="text-[12rem] font-black text-luxury-wood/20 leading-none select-none">404</h1>
        <div class="relative -mt-20">
            <h2 class="text-3xl md:text-5xl font-black text-luxury-black dark:text-white mb-6">عذراً، هذه الصفحة غير موجودة!</h2>
            <p class="text-gray-500 dark:text-gray-400 text-lg mb-10 max-w-md mx-auto leading-relaxed">
                يبدو أن الرابط الذي اتبعته غير صحيح أو أن الصفحة قد تم نقلها لمكان آخر.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 bg-luxury-wood text-white px-10 py-4 rounded-2xl font-black text-lg hover:bg-[#6b4423] transition shadow-2xl transform hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                العودة للرئيسية
            </a>
        </div>
    </div>
</div>
@endsection
