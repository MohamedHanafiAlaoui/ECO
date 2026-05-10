<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Http\Controllers\CaptchaController;

class CaptchaRule implements Rule
{
    public function passes($attribute, $value)
    {
        return CaptchaController::verify($value);
    }

    public function message()
    {
        return 'إجابة التحقق (Captcha) غير صحيحة، يرجى المحاولة مرة أخرى.';
    }
}
