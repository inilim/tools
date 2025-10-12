<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get an array item from an array using "dot" notation.
 *
 * @param ArrayAccess|array $array
 * @param string|int|null $key
 * @return array
 *
 * @throws \InvalidArgumentException
 */
function _array($array, $key, ?array $default = null)
{
    $value = \Inilim\Tool\Method\LarArr\get($array, $key, $default);

    if (! \is_array($value)) {
        throw new \InvalidArgumentException(
            \sprintf('Array value for key [%s] must be an array, %s found.', $key, \gettype($value))
        );
    }

    return $value;
}
