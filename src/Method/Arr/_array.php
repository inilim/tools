<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * Get an array item from an array using "dot" notation.
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
function _array($array, $key, ?array $default = null): array
{
    $value = \Inilim\Tool\Method\Arr\get($array, $key, $default);

    if (!\is_array($value)) {
        throw new \InvalidArgumentException(
            \sprintf('Array value for key [%s] must be an array, %s found.', $key, \gettype($value))
        );
    }

    return $value;
}
