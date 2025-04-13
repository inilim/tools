<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Repeat the given string.
 */
function repeat(string $string, int $times): string
{
    return \str_repeat($string, $times);
}
