<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @build_skip
 * @template T of string|int
 * @param array<T> $array
 * @return array<T,int>
 */
function countValues(array $array): array
{
    $ret_array = [];
    foreach ($array as $value) {
        foreach ($ret_array as $key2 => $value2) {
            if (strtolower($key2) == strtolower($value)) {
                $ret_array[$key2]++;
                continue 2;
            }
        }
        $ret_array[$value] = 1;
    }
    return $ret_array;
}
