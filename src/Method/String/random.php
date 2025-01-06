<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include('__state');

/**
 * Generate a more truly "random" alpha-numeric string.
 */
function random(int $length = 16): string
{
    return (\Inilim\Method\String\__state()->randomStringFactory ?? static function ($length) {
        $string = '';

        while (($len = \strlen($string)) < $length) {
            $size = $length - $len;

            $bytesSize = (int) \ceil($size / 3) * 3;

            $bytes = \random_bytes($bytesSize);

            $string .= \substr(\str_replace(['/', '+', '='], '', \base64_encode($bytes)), 0, $size);
        }

        return $string;
    })($length);
}
