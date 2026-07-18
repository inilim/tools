<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get one or a specified number of random values from an array.
 *
 * @build_skip
 * @param  array  $array
 * @param  int|null  $number
 * @param  bool  $preserveKeys
 * @return ($number is null ? mixed : array)
 *
 * @throws \InvalidArgumentException
 */
function random($array, $number = null, $preserveKeys = false)
{
    $requested = \is_null($number) ? 1 : $number;

    $count = \count($array);

    if ($requested > $count) {
        throw new \InvalidArgumentException(
            "You requested {$requested} items, but there are only {$count} items available."
        );
    }

    if (empty($array) || (! \is_null($number) && $number <= 0)) {
        return \is_null($number) ? null : [];
    }

    // TODO
    $keys = (new Randomizer)->pickArrayKeys($array, $requested);

    if (\is_null($number)) {
        return $array[$keys[0]];
    }

    $results = [];

    if ($preserveKeys) {
        foreach ($keys as $key) {
            $results[$key] = $array[$key];
        }
    } else {
        foreach ($keys as $key) {
            $results[] = $array[$key];
        }
    }

    return $results;
}
