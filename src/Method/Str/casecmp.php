<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * mb_strcasecmp
 */
function casecmp(string $str1, string $str2, string $encoding = 'UTF-8'): int
{
    return \strcmp(\mb_strtoupper($str1, $encoding), \mb_strtoupper($str2, $encoding));
}
