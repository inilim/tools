<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'upper',
    'substr',
]);

/**
 * Make a string's first character uppercase.
 */
function ucfirst(string $string): string
{
    return upper(substr($string, 0, 1)) . substr($string, 1);
}
