<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\SecurityHelper;

class SanitizeInput
{
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();
        
        $except = ['description', 'header_code', 'footer_code', 'content'];

        // Recursively sanitize all input strings except those in $except
        foreach ($input as $key => $value) {
            if (!in_array($key, $except)) {
                $input[$key] = $this->sanitizeRecursive($value);
            }
        }

        $request->merge($input);

        return $next($request);
    }

    protected function sanitizeRecursive($data)
    {
        if (is_array($data)) {
            return array_map([$this, 'sanitizeRecursive'], $data);
        }

        if (is_string($data)) {
            return SecurityHelper::sanitize($data);
        }

        return $data;
    }
}
