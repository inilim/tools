<?php

namespace Inilim\Method\String;

/**
 * Pad both sides of a string with another.
 */
function padBoth(string $value, int $length, string $pad = ' '): string
{
    if (\PHP_VERSION_ID >= 80300) {
        return \mb_str_pad($value, $length, $pad, \STR_PAD_BOTH);
    }

    $short      = \max(0, $length - \mb_strlen($value));
    $shortLeft  = \floor($short / 2);
    $shortRight = \ceil($short / 2);

    return \mb_substr(\str_repeat($pad, $shortLeft), 0, $shortLeft) .
        $value .
        \mb_substr(\str_repeat($pad, $shortRight), 0, $shortRight);
}
