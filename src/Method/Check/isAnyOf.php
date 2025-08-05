<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * @psalm-assert-if-true T|class-string<T> $value
 * @phpstan-assert-if-true T|class-string<T> $value
 * 
 * @param object|string $value
 * @param class-string<T>[] $classes
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
