<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Determine whether the given value is array accessible.
 * @param mixed $value
 * @return bool
 */
function accessible($value)
{
    return \is_array($value) || $value instanceof \ArrayAccess;
}
