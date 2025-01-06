<?php

namespace Inilim\Method\String;

/**
 * Pad the right side of a string with another.
 */
function padRight(string $value, int $length, string $pad = ' '): string
{
    if (\PHP_VERSION_ID >= 80300) {
        return \mb_str_pad($value, $length, $pad, \STR_PAD_RIGHT);
    }

    $short = \max(0, $length - \mb_strlen($value));
    return $value . \mb_substr(\str_repeat($pad, $short), 0, $short);
}
