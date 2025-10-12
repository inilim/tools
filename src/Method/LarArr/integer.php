<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get an integer item from an array using "dot" notation.
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 * @throws \InvalidArgumentException
 */
function integer($array, $key, ?int $default = null): int
{
    $value = \Inilim\Tool\Method\LarArr\get($array, $key, $default);

    if (! \is_int($value)) {
        throw new \InvalidArgumentException(
            \sprintf('Array value for key [%s] must be an integer, %s found.', $key, \gettype($value))
        );
    }

    return $value;
}
