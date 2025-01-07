<?php

namespace Inilim\Tool\Method\String;

/**
 * Cap a string with a single instance of a given value.
 */
function finish(string $value, string $cap): string
{
    $quoted = \preg_quote($cap, '/');

    return \preg_replace('/(?:' . $quoted . ')+$/u', '', $value) . $cap;
}
