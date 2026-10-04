<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Make a string's first character lowercase.
 *
 * @param  string  $string
 * @return ($string is '' ? '' : non-empty-string)
 * 
 * @ext mbstring
 */
function lcfirst($string)
{
    return \mb_lcfirst($string, 'UTF-8');
}
