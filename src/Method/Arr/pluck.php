<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('dataGet');

/**
 * Pluck an array of values from an array.
 * @param  string|array|int|null  $value
 * @param  string|string[]|null  $key
 */
function pluck(iterable $array, $value, $key = null): array
{
    $results = [];

    $value = \is_string($value) ? \explode('.', $value) : $value;

    $key = $key === null || \is_array($key) ? $key : \explode('.', $key);

    foreach ($array as $item) {
        $itemValue = \Inilim\Method\Arr\dataGet($item, $value);

        // If the key is "null", we will just append the value to the array and keep
        // looping. Otherwise we will key the array using the value of the key we
        // received from the developer. Then we'll return the final array form.
        if ($key === null) {
            $results[] = $itemValue;
        } else {
            $itemKey = \Inilim\Method\Arr\dataGet($item, $key);

            if (\is_object($itemKey) && \method_exists($itemKey, '__toString')) {
                $itemKey = (string) $itemKey;
            }

            $results[$itemKey] = $itemValue;
        }
    }

    return $results;
}
