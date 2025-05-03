<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @param \UnitEnum $enum
 * @param \UnitEnum[] $haystack
 */
function in(object $enum, array $haystack): bool
{
    \Inilim\Tool\Method\Assert\enumCase($enum);
    foreach ($haystack as $item) {
        if ($enum === $item) {
            return true;
        }
    }
    return false;
}
