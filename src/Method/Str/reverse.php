<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Reverse the given string.
 * @return string
 */
function reverse(string $value)
{
    return \implode(\array_reverse(\mb_str_split($value)));
}
