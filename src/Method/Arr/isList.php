<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @return bool
 */
function isList(array $array)
{
    if (\PHP_VERSION_ID >= 80100) {
        return \array_is_list($array);
    }

    if ([] === $array || $array === \array_values($array)) {
        return true;
    }

    $nextKey = -1;

    foreach ($array as $k => &$v) {
        if ($k !== ++$nextKey) {
            return false;
        }
    }

    return true;
}
