<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Convert the given string to lower-case.
 *
 * @param  string  $value
 * @return ($value is '' ? '' : non-empty-string&lowercase-string)
 * 
 * @ext mbstring
 */
function lower($value)
{
    return \mb_strtolower($value, 'UTF-8');
}
