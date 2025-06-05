<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * Get a boolean item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
function boolean($array, $key, ?bool $default = null): bool
{
    $value = \Inilim\Tool\Method\Arr\get($array, $key, $default);

    if (!\is_bool($value)) {
        throw new \InvalidArgumentException(
            \sprintf('Array value for key [%s] must be a boolean, %s found.', $key, \gettype($value))
        );
    }

    return $value;
}
