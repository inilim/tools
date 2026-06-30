<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Make a string's first character uppercase.
 *
 * @param  string  $string
 * @return ($string is '' ? '' : non-empty-string)
 */
function ucfirst($string)
{
    return \Inilim\Tool\Method\LarStr\upper(\Inilim\Tool\Method\LarStr\substr($string, 0, 1)) . \Inilim\Tool\Method\LarStr\substr($string, 1);
}
