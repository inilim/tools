<?php

namespace Inilim\Tool\Method\String;

/**
 * Convert the case of a string.
 */
function convertCase(string $string, int $mode = \MB_CASE_FOLD, ?string $encoding = 'UTF-8'): string
{
    return \mb_convert_case($string, $mode, $encoding);
}
