<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Return the length of the given string.
 *
 * @param  string  $value
 * @param  string|null  $encoding
 * @return non-negative-int
 * 
 * @ext mbstring
 */
function length($value, $encoding = null)
{
    return \mb_strlen($value, $encoding);
}
