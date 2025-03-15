<?php

namespace Inilim\Tool\Method\String;

/**
 * Convert the given string to upper-case.
 * @return string
 */
function upper(string $value, ?string $encoding = 'UTF-8')
{
    return \mb_strtoupper($value, $encoding);
}
