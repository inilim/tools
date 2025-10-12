<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get a boolean item from an array using "dot" notation.
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 *
 * @throws \InvalidArgumentException
 */
function boolean($array, $key, ?bool $default = null): bool
{
    $value = \Inilim\Tool\Method\LarArr\get($array, $key, $default);

    if (! \is_bool($value)) {
        throw new \InvalidArgumentException(
            \sprintf('Array value for key [%s] must be a boolean, %s found.', $key, \gettype($value))
        );
    }

    return $value;
}
