<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Flatten a multi-dimensional associative array with dots.
 *
 * @param  iterable  $array
 * @param  string  $prepend
 * @param  int  $depth
 * @return array
 */
function dot($array, $prepend = '', $depth = \INF)
{
    $results = [];

    $flatten = static function ($data, $prefix, $currentDepth) use (&$results, &$flatten, $depth): void {
        foreach ($data as $key => $value) {
            $newKey = $prefix . $key;

            if (\is_array($value) && ! empty($value) && $currentDepth < $depth) {
                $flatten($value, $newKey . '.', $currentDepth + 1);
            } else {
                $results[$newKey] = $value;
            }
        }
    };

    $flatten($array, $prepend, 0);

    // Destroy self-referencing closure to avoid memory leak...
    $flatten = null;

    return $results;
}
