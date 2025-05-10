<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
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
