<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Begin a string with a single instance of a given value.
 * 
 * @return ($value is '' ? ($prefix is '' ? '' : non-empty-string): non-empty-string)
 */
function start(string $value, string $prefix): string
{
    $quoted = \preg_quote($prefix, '/');

    return $prefix . \preg_replace('/^(?:' . $quoted . ')+/u', '', $value);
}
