<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true \ArrayAccess&\Traversable&\Countable $value
 * @phpstan-assert-if-true \ArrayAccess&\Traversable&\Countable $value
 * 
 * @param mixed $value
 */
function arrLike($value): bool
{
    if (
        \is_object($value) &&
        $value instanceof \Traversable &&
        $value instanceof \Countable &&
        $value instanceof \ArrayAccess
    ) {
        return true;
    }
    return false;
}
