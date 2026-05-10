<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    /**
     * Generate a simple math captcha.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate()
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $operators = ['+', '-'];
        $operator = $operators[array_rand($operators)];

        if ($operator == '-') {
            // Ensure no negative results for simplicity
            if ($num1 < $num2) {
                $temp = $num1;
                $num1 = $num2;
                $num2 = $temp;
            }
            $result = $num1 - $num2;
        } else {
            $result = $num1 + $num2;
        }

        $question = "{$num1} {$operator} {$num2}";
        
        Session::put('captcha_result', $result);

        return response()->json([
            'question' => $question
        ]);
    }

    /**
     * Verify the captcha result.
     *
     * @param int $value
     * @return bool
     */
    public static function verify($value)
    {
        $expected = Session::get('captcha_result');
        return $value !== null && (int)$value === (int)$expected;
    }
}
