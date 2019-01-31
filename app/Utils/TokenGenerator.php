<?php

namespace App\Utils;

use Illuminate\Support\Str;

class TokenGenerator
{
    /**
     * Generate random token
     *
     * @return string
     */
    public static function generate(): string
    {
        $key = config('app.key');

        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        return hash_hmac('sha256', Str::random(40), $key);
    }
}
