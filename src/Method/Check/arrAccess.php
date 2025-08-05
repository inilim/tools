<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true \ArrayAccess $value
 * @phpstan-assert-if-true \ArrayAccess $value
 * 
 * @param mixed $value
 */
function arrAccess($value): bool
{
    if ($value instanceof \ArrayAccess) {
        return true;
    }
    return false;
}
