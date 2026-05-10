<?php

namespace App\Helpers;

class SecurityHelper
{
    /**
     * Sanitize input data to prevent XSS.
     *
     * @param mixed $data
     * @return mixed
     */
    public static function sanitize($data)
    {
        if (is_array($data)) {
            return array_map([self::class, 'sanitize'], $data);
        }

        if (is_string($data)) {
            return htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8');
        }

        return $data;
    }

    /**
     * Check if an IP is suspicious (simple check for now).
     *
     * @param string $ip
     * @return bool
     */
    public static function isSuspicious($ip)
    {
        // Add logic to check against a blacklist or repeated failed attempts
        return false;
    }
}
