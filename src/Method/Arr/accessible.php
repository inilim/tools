<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @todo to Check
 * @author Laravel
 * Determine whether the given value is array accessible.
 * @param mixed $value
 */
function accessible($value): bool
{
    return \is_array($value) || $value instanceof \ArrayAccess;
}
