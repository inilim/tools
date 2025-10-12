<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Pluck an array of values from an array.
 *
 * @param  iterable  $array
 * @param  string|array|int|\Closure|null  $value
 * @param  string|array|\Closure|null  $key
 * @return array
 */
function pluck($array, $value, $key = null)
{
    $results = [];

    // INFO 
    // [$value, $key] = static::explodePluckParameters($value, $key);
    $value = \is_string($value) ? \explode('.', $value) : $value;
    $key = \is_null($key) || \is_array($key) || $key instanceof \Closure ? $key : \explode('.', $key);

    foreach ($array as $item) {
        $itemValue = $value instanceof \Closure
            ? $value($item)
            : \Inilim\Tool\Method\Lar\dataGet($item, $value);

        // If the key is "null", we will just append the value to the array and keep
        // looping. Otherwise we will key the array using the value of the key we
        // received from the developer. Then we'll return the final array form.
        if (\is_null($key)) {
            $results[] = $itemValue;
        } else {
            $itemKey = $key instanceof \Closure
                ? $key($item)
                : \Inilim\Tool\Method\Lar\dataGet($item, $key);

            if (\is_object($itemKey) && \method_exists($itemKey, '__toString')) {
                $itemKey = (string) $itemKey;
            }

            $results[$itemKey] = $itemValue;
        }
    }

    return $results;
}
