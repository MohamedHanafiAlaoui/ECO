<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HoneypotMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Field-based Honeypot (hidden field that bots fill)
        if ($request->filled('website_url')) {
            return response()->json(['message' => 'Spam detected.'], 422);
        }

        // 2. Time-based Honeypot (bots submit too fast)
        $formTime = $request->input('_form_time');
        if ($formTime) {
            $decryptedTime = decrypt($formTime);
            if (time() - $decryptedTime < 3) { // Minimum 3 seconds
                return response()->json(['message' => 'Submission too fast. Please wait.'], 422);
            }
        }

        return $next($request);
    }
}
