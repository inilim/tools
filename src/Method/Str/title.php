<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert the given string to proper case.
 */
function title(string $value): string
{
    return \mb_convert_case($value, \Inilim\Tool\PF::MB_CASE_TITLE, 'UTF-8');
}
