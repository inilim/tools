<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Begin a string with a single instance of a given value.
 *
 * @param  string  $value
 * @param  string  $prefix
 * @return ($value is '' ? ($prefix is '' ? '' : non-empty-string): non-empty-string)
 */
function start($value, $prefix)
{
    if ($prefix === '') {
        return $value;
    }

    if (! \Inilim\Tool\Method\PF\str_starts_with($value, $prefix)) {
        return $prefix . $value;
    }

    if (! \Inilim\Tool\Method\PF\str_starts_with($value, $prefix . $prefix)) {
        return $value;
    }

    $quoted = \preg_quote($prefix, '/');

    return $prefix . \preg_replace('/^(?:' . $quoted . ')+/u', '', $value);
}
