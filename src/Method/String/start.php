<?php

namespace Inilim\Tool\Method\String;

/**
 * Begin a string with a single instance of a given value.
 */
function start(string $value, string $prefix): string
{
    $quoted = \preg_quote($prefix, '/');

    return $prefix . \preg_replace('/^(?:' . $quoted . ')+/u', '', $value);
}
