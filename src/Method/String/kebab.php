<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('snake');

/**
 * Convert a string to kebab case.
 */
function kebab(string $value): string
{
    return snake($value, '-');
}
