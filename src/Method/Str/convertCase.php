<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert the case of a string.
 * @return string
 */
function convertCase(string $string, int $mode = \Inilim\Tool\PF::MB_CASE_FOLD, ?string $encoding = 'UTF-8')
{
    return \mb_convert_case($string, $mode, $encoding);
}
