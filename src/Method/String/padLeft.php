<?php

namespace Inilim\Tool\Method\String;

/**
 * Pad the left side of a string with another.
 */
function padLeft(string $value, int $length, string $pad = ' '): string
{
    if (\PHP_VERSION_ID >= 80300) {
        return \mb_str_pad($value, $length, $pad, \STR_PAD_LEFT);
    }

    $short = \max(0, $length - \mb_strlen($value));

    return \mb_substr(\str_repeat($pad, $short), 0, $short) . $value;
}
