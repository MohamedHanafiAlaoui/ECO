@extends('layouts.app')

@section('title', '500 - خطأ داخلي')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center bg-luxury-beige dark:bg-gray-900 px-4">
    <div class="text-center" data-aos="zoom-in">
        <h1 class="text-[12rem] font-black text-red-500/10 leading-none select-none">500</h1>
        <div class="relative -mt-20">
            <h2 class="text-3xl md:text-5xl font-black text-luxury-black dark:text-white mb-6">حدث خطأ غير متوقع!</h2>
            <p class="text-gray-500 dark:text-gray-400 text-lg mb-10 max-w-md mx-auto leading-relaxed">
                نحن نعتذر عن هذا الإزعاج، فريقنا التقني يعمل على حل المشكلة حالياً. يرجى المحاولة مرة أخرى لاحقاً.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 bg-luxury-wood text-white px-10 py-4 rounded-2xl font-black text-lg hover:bg-[#6b4423] transition shadow-2xl">
                    العودة للرئيسية
                </a>
                <button onclick="location.reload()" class="inline-flex items-center gap-3 bg-white dark:bg-gray-800 text-luxury-black dark:text-white border border-gray-200 dark:border-gray-700 px-10 py-4 rounded-2xl font-black text-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                    تحديث الصفحة
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
