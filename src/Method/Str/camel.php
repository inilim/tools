<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated LarStr
 * Convert a value to camel case.
 * @return string
 */
function camel(string $value)
{
    return \lcfirst(\Inilim\Tool\Method\Str\studly($value));
}
