<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * Get an integer item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 */
function integer($array, $key, ?int $default = null): int
{
    $value = \Inilim\Tool\Method\Arr\get($array, $key, $default);

    if (!\is_int($value)) {
        throw new \InvalidArgumentException(
            \sprintf('Array value for key [%s] must be an integer, %s found.', $key, \gettype($value))
        );
    }

    return $value;
}
