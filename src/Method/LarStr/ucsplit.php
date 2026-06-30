<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Split a string into pieces by uppercase characters.
 *
 * @param  string  $string
 * @return ($string is '' ? array{} : string[])
 */
function ucsplit($string)
{
    return \preg_split('/(?=\p{Lu})/u', $string, -1, \PREG_SPLIT_NO_EMPTY);
}
