<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Convert the given string to upper-case.
 *
 * @param  string  $value
 * @return ($value is '' ? '' : non-empty-string&uppercase-string)
 * 
 * @ext mbstring
 */
function upper($value)
{
    return \mb_strtoupper($value, 'UTF-8');
}
