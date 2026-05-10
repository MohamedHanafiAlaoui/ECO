<div class="space-y-3" x-data="{ 
    captchaQuestion: 'جاري التحميل...',
    refreshCaptcha() {
        fetch('{{ route('captcha.generate') }}')
            .then(res => res.json())
            .then(data => {
                this.captchaQuestion = data.question;
            });
    }
}" x-init="refreshCaptcha()">
    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mr-2">تحقق الأمان (Captcha)</label>
    <div class="flex items-center gap-4 flex-row-reverse">
        <div class="bg-luxury-wood/10 text-luxury-wood font-black px-6 py-4 rounded-2xl border border-luxury-wood/20 min-w-[100px] text-center text-xl">
            <span x-text="captchaQuestion"></span>
        </div>
        <button type="button" @click="refreshCaptcha()" class="p-4 text-gray-400 hover:text-luxury-wood transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
        </button>
        <div class="flex-grow">
            <input type="number" name="captcha" required 
                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-luxury-wood/20 text-center" 
                placeholder="أدخل ناتج العملية">
        </div>
    </div>
    @error('captcha')
        <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
    @enderror
</div>

