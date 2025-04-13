<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * mb_strcasecmp
 * @return int
 */
function casecmp(string $str1, string $str2, string $encoding = 'UTF-8')
{
    return \strcmp(\mb_strtoupper($str1, $encoding), \mb_strtoupper($str2, $encoding));
}
