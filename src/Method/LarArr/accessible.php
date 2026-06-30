<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determine whether the given value is array accessible.
 *
 * @param  mixed  $value
 */
function accessible($value): bool
{
    return \is_array($value) || $value instanceof \ArrayAccess;
}
