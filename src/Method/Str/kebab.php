<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert a string to kebab case.
 * @return string
 */
function kebab(string $value)
{
    return \Inilim\Tool\Method\Str\snake($value, '-');
}
