<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-pure
 * @param mixed  $value
 * @param mixed[] $values
 */
function allInArray($value, array $values): bool
{
    if (!\is_iterable($value)) {
        return false;
    }

    foreach ($value as $entry) {
        if (!\in_array($entry, $values, true)) {
            return false;
        }
    }

    return true;
}
