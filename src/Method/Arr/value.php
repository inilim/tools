<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Return the default value of the given value.
 * @param  mixed $value
 * @return mixed
 */
function value($value)
{
    return $value instanceof \Closure ? $value() : $value;
}
