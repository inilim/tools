<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Run an associative map over each of the items.
 * The callback should return an associative array with a single key/value pair.
 * @template TKey
 * @template TValue
 * @template TMapWithKeysKey of array-key
 * @template TMapWithKeysValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  callable(TValue, TKey): array<TMapWithKeysKey, TMapWithKeysValue>  $callback
 * @return array
 */
function mapWithKeys(array $array, callable $callback): array
{
    $result = [];

    foreach ($array as $key => $value) {
        $assoc = $callback($value, $key);

        foreach ($assoc as $map_key => $map_value) {
            $result[$map_key] = $map_value;
        }
    }

    return $result;
}
