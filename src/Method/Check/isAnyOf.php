<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @psalm-pure
 * @psalm-param array<class-string> $classes
 * @param object|string $value
 * @param string[]      $classes
 */
function isAnyOf($value, array $classes): bool
{
    foreach ($classes as $class) {
        \Inilim\Tool\Method\Assert\string($class, 'Expected class as a string. Got: %s');
        if (\is_a($value, $class, \is_string($value))) {
            return true;
        }
    }
    return false;
}
