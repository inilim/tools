<?php

namespace Inilim\Tool\Method\Arr;

/**
 * If the given value is not an array, wrap it in one.
 * @param mixed $value
 */
function wrap($value): array
{
    return \is_array($value) ? $value : [$value];
}
