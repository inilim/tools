<?php

namespace Inilim\Method\Arr;

/**
 * Get one or a specified number of random values from an array.
 * @template TValue
 * @template TKey
 * @param  array<TKey,TValue>  $array
 * @param  int|null  $number
 * @param  bool  $preserve_keys
 *
 * @return TValue|TValue[]|array<TKey,TValue>|array{}
 *
 * @throws \InvalidArgumentException
 */
function random(array $array, ?int $number = null, bool $preserve_keys = false)
{
    $requested = $number === null ? 1 : $number;

    $count = \sizeof($array);

    if ($requested > $count) {
        throw new \InvalidArgumentException(
            "You requested {$requested} items, but there are only {$count} items available."
        );
    }

    if ($number === null) {
        return $array[\array_rand($array)];
    }

    if ((int) $number === 0) {
        return [];
    }

    $keys = \array_rand($array, $number);

    $results = [];

    if ($preserve_keys) {
        foreach ((array) $keys as $key) {
            $results[$key] = $array[$key];
        }
    } else {
        foreach ((array) $keys as $key) {
            $results[] = $array[$key];
        }
    }

    return $results;
}
