<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Returns the portion of the string specified by the start and length parameters.
 *
 * @param  string  $string
 * @param  int  $start
 * @param  int|null  $length
 * @param  string  $encoding
 * @return string
 * 
 * @ext mbstring
 */
function substr($string, $start, $length = null, $encoding = 'UTF-8')
{
    return \mb_substr($string, $start, $length, $encoding);
}
