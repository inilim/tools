<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get a string item from an array using "dot" notation.
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
function string($array, $key, ?string $default = null): string
{
    $value = \Inilim\Tool\Method\LarArr\get($array, $key, $default);

    if (! \is_string($value)) {
        throw new \InvalidArgumentException(
            \sprintf('Array value for key [%s] must be a string, %s found.', $key, \gettype($value))
        );
    }

    return $value;
}
