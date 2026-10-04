<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Remove all non-numeric characters from a string.
 *
 * @param  string|string[]  $value
 * @return ($value is string ? string : string[])
 */
function numbers($value)
{
    return \preg_replace('/\D/', '', $value);
}
