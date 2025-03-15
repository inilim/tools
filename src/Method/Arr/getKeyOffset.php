<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Returns zero-indexed position of given array key. Returns null if key is not found.
 * @param string|int $key
 * @return null|int
 */
function getKeyOffset(array $array, $key)
{
    $value = \array_search(
        \key([$key => null]),
        \array_keys($array),
        true
    );
    return $value === false ? null : $value;
}
