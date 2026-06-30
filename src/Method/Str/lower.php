<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated LarStr::...
 * Convert the given string to lower-case.
 * @ext mbstring
 */
function lower(string $value, ?string $encoding = 'UTF-8'): string
{
    return \mb_strtolower($value, $encoding);
}
