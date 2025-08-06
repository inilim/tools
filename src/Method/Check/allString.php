<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true iterable<string> $value
 * @phpstan-assert-if-true iterable<string> $value
 * 
 * @param mixed $value
 */
function allString($value): bool
{
    if (!\Inilim\Tool\Method\Check\isIterable($value)) {
        return false;
    }
    /** @var iterable $value */

    foreach ($value as $item) {
        if (!\is_string($item)) {
            return false;
        }
    }
    return true;
}
