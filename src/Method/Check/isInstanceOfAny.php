<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @psalm-pure
 * @psalm-param array<class-string> $classes
 * @param mixed                $value
 * @param array<object|string> $classes
 */
function isInstanceOfAny($value, array $classes): bool
{
    foreach ($classes as $class) {
        if ($value instanceof $class) {
            return true;
        }
    }
    return false;
}
