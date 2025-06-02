<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Flatten a multi-dimensional associative array with dots.
 * @return array<string,mixed>
 */
function dot(iterable $array, string $prepend = '')
{
    $results = [];

    $flatten = static function (iterable $data, string $prefix) use (&$results, &$flatten) {
        foreach ($data as $key => $value) {
            $newKey = $prefix . $key;

            if (\is_array($value) && ! empty($value)) {
                $flatten($value, $newKey . '.');
            } else {
                $results[$newKey] = $value;
            }
        }
    };

    $flatten($array, $prepend);

    return $results;
}
