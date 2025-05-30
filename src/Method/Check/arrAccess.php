<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true \ArrayAccess $value
 */
function arrAccess($value): bool
{
    if ($value instanceof \ArrayAccess) {
        return true;
    }
    return false;
}
