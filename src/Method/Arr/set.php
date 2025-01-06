<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Set an array item to a given value using "dot" notation.
 * If no key is given to the method, the entire array will be replaced.
 * @param mixed $value
 */
function set(array &$array, ?string $key, $value): array
{
    if ($key === null) {
        return $array = $value;
    }

    $keys = \explode('.', $key);

    foreach ($keys as $i => $key) {
        if (\sizeof($keys) === 1) {
            break;
        }

        unset($keys[$i]);

        // If the key doesn't exist at this depth, we will just create an empty array
        // to hold the next value, allowing us to create the arrays to hold final
        // values at the correct depth. Then we'll keep digging into the array.
        if (!isset($array[$key]) || !\is_array($array[$key])) {
            $array[$key] = [];
        }

        $array = &$array[$key];
    }

    $array[\array_shift($keys)] = $value;

    return $array;
}
