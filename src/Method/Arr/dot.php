<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author Laravel
 * Flatten a multi-dimensional associative array with dots.
 * @return array<string,mixed>
 */
function dot(iterable $array, string $prepend = '', string $separator = '.'): array
{
    $results = [];

    $flatten = static function (iterable $data, string $prefix, string $separator) use (&$results, &$flatten) {
        foreach ($data as $key => $value) {
            $newKey = $prefix . $key;

            if (\is_array($value) && ! empty($value)) {
                $flatten($value, $newKey . $separator, $separator);
            } else {
                $results[$newKey] = $value;
            }
        }
    };

    $flatten($array, $prepend, $separator);

    $flatten = null;

    return $results;
}
