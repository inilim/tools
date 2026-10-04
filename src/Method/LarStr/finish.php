<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Cap a string with a single instance of a given value.
 *
 * @param  string  $value
 * @param  string  $cap
 * @return ($value is '' ? ($cap is '' ? '' : non-empty-string) : non-empty-string)
 */
function finish($value, $cap)
{
    if ($cap === '') {
        return $value;
    }

    if (! \str_ends_with($value, $cap)) {
        return $value . $cap;
    }

    if (! \str_ends_with($value, $cap . $cap)) {
        return $value;
    }

    $quoted = \preg_quote($cap, '/');

    return \preg_replace('/(?:' . $quoted . ')+$/u', '', $value) . $cap;
}
