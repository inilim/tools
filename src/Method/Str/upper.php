<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert the given string to upper-case.
 */
function upper(string $value, ?string $encoding = 'UTF-8'): string
{
    return \mb_strtoupper($value, $encoding);
}
