<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove all non-numeric characters from a string.
 * @param string[]|string $value
 * @return ($value is string ? string : string[])
 */
function numbers($value)
{
    return \preg_replace('/[^0-9]/', '', $value);
}
