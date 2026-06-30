<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Convert the given string to proper case.
 *
 * @param  string  $value
 * @return string
 * 
 * @ext mbstring
 */
function title($value)
{
    return \mb_convert_case($value, \MB_CASE_TITLE, 'UTF-8');
}
