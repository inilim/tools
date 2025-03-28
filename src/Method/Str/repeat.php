<?php

namespace Inilim\Tool\Method\Str;

/**
 * Repeat the given string.
 */
function repeat(string $string, int $times): string
{
    return \str_repeat($string, $times);
}
