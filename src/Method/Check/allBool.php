<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true iterable<bool> $value
 * @phpstan-assert-if-true iterable<bool> $value
 * 
 * @param mixed  $value
 */
function allBool($value): bool
{
    if (!\is_iterable($value)) {
        return false;
    }

    foreach ($value as $entry) {
        if (!\is_bool($entry)) {
            return false;
        }
    }

    return true;
}
