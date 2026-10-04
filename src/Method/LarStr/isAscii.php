<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Determine if a given string is 7 bit ASCII.
 *
 * @param  string  $value
 * @return bool
 */
function isAscii($value)
{
    return \Inilim\Tool\Method\Str\is_ascii((string) $value);
}
