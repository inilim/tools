<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true iterable<null|mixed[]> $value
 * @phpstan-assert-if-true iterable<null|mixed[]> $value
 * 
 * @param mixed  $value
 */
function allNullOrArray($value): bool
{
    if (!\is_iterable($value)) {
        return false;
    }

    foreach ($value as $entry) {
        if ($entry === null) {
            continue;
        }
        if (!\is_array($entry)) {
            return false;
        }
    }

    return true;
}
