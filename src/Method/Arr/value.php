<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

/**
 * Return the default value of the given value.
 * @param  mixed $value
 * @return mixed
 */
function value($value)
{
    return $value instanceof \Closure ? $value() : $value;
}
