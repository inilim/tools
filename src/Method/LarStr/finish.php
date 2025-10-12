<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Cap a string with a single instance of a given value.
 *
 * @param  string  $value
 * @param  string  $cap
 * @return string
 */
function finish($value, $cap)
{
    $quoted = \preg_quote($cap, '/');

    return \preg_replace('/(?:' . $quoted . ')+$/u', '', $value) . $cap;
}
