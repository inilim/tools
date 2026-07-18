<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @template T of (mixed[]|object)[]
 * @param T $arr
 * @return T
 */
function sortBy(array $arr, string $by, int $options = \SORT_REGULAR, bool $descending = false): array
{
    $t = [];
    foreach ($arr as $key => $value) {
        if (\is_array($value) || \is_object($value)) {
            $t[$key] = \Inilim\Tool\Method\Lar\dataGet($value, $by);
        } else {
            $t[$key] = null;
        }
    }

    $descending ? \arsort($t, $options) : \asort($t, $options);

    foreach (\array_keys($t) as $key) {
        $t[$key] = $arr[$key];
    }

    return $t;
}
