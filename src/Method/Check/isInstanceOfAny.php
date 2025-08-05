<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * 
 * @psalm-assert-if-true T $value
 * @phpstan-assert-if-true T $value
 * 
 * @param mixed $value
 * @param array<T|class-string<T>> $classes
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

// $a = \DOMDocument::class;
// var_dump($a instanceof $a); // false