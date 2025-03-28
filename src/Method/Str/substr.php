<?php

namespace Inilim\Tool\Method\Str;

/**
 * Returns the portion of the string specified by the start and length parameters.
 * @return string
 */
function substr(string $string, int $start, ?int $length = null, string $encoding = 'UTF-8')
{
    return \mb_substr($string, $start, $length, $encoding);
}
