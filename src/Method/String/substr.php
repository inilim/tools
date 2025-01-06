<?php

namespace Inilim\Method\String;

/**
 * Returns the portion of the string specified by the start and length parameters.
 */
function substr(string $string, int $start, ?int $length = null, string $encoding = 'UTF-8'): string
{
    return \mb_substr($string, $start, $length, $encoding);
}
