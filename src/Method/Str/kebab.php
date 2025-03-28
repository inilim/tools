<?php

namespace Inilim\Tool\Method\Str;

/**
 * Convert a string to kebab case.
 */
function kebab(string $value): string
{
    return \Inilim\Tool\Method\Str\snake($value, '-');
}
