<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * Get a float item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 */
function float($array, $key, ?float $default = null): float
{
    $value = \Inilim\Tool\Method\Arr\get($array, $key, $default);

    if (!\is_float($value)) {
        throw new \InvalidArgumentException(
            \sprintf('Array value for key [%s] must be a float, %s found.', $key, \gettype($value))
        );
    }

    return $value;
}
