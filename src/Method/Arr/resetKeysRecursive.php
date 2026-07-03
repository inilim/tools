<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @template V
 * @template K
 * @param array<K,V> $array
 * @return V[]
 */
function resetKeysRecursive(array $array): array
{
    $internal = static function (array $array) use (&$internal): array {
        $array = \array_values($array);
        foreach ($array as $idx => $value) {
            $array[$idx] = \is_array($value) ? $internal($value) : $value;
        }
        return $array;
    };

    $array = $internal($array);

    $internal = null;

    return $array;
}
