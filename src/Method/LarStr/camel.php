<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Convert a value to camel case.
 *
 * @param  string  $value
 * @return ($value is '' ? '' : string)
 */
function camel($value)
{
    $c = &\Inilim\Tool\Method\LarStr\__state()->camelCache;
    return $c[$value] ?? $c[$value] = \lcfirst(\Inilim\Tool\Method\LarStr\studly($value));
}
