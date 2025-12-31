<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author inilim
 * Return the length of the given string.
 * Without mbstring
 */
function length_m2(string $value): int
{
    return (int)\preg_match_all('/.{1}/us', $value);
}
