<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'lower',
    'substr',
]);

/**
 * Make a string's first character lowercase.
 */
function lcfirst(string $string): string
{
    return lower(substr($string, 0, 1)) . substr($string, 1);
}
