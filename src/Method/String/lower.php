<?php

namespace Inilim\Tool\Method\String;

/**
 * Convert the given string to lower-case.
 * @return string
 */
function lower(string $value, ?string $encoding = 'UTF-8')
{
    return \mb_strtolower($value, $encoding);
}
