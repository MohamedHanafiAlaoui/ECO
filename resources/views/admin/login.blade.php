<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول المشرف</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'luxury-black': '#111111',
                        'luxury-wood': '#8b5a2b',
                    }
                }
            }
        }
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>body { font-family: 'Cairo', sans-serif; }</style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-10 rounded-3xl shadow-xl w-full max-w-md text-right">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-luxury-black">دخول المشرف</h1>
            <p class="text-gray-500 mt-2">يرجى إدخال بيانات الاعتماد الخاصة بك</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label class="block font-bold">البريد الإلكتروني</label>
                <input type="email" name="email" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 focus:ring-luxury-wood focus:border-luxury-wood" placeholder="admin@luxury.com">
            </div>
            <div class="space-y-2">
                <label class="block font-bold">كلمة المرور</label>
                <input type="password" name="password" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 focus:ring-luxury-wood focus:border-luxury-wood" placeholder="********">
            </div>

            <!-- Captcha -->
            @include('components.captcha')

            <button type="submit" class="w-full bg-luxury-wood text-white py-4 rounded-xl font-bold text-lg hover:bg-[#6b4423] transition shadow-lg mt-4">دخول</button>
        </form>
    </div>
</body>
</html>

