<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert a value to camel case.
 */
function camel(string $value): string
{
    return \lcfirst(\Inilim\Tool\Method\Str\studly($value));
}
