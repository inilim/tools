<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert the given string to upper-case.
 * @return string
 */
function upper(string $value, ?string $encoding = 'UTF-8')
{
    return \mb_strtoupper($value, $encoding);
}
