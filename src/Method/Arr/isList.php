<?php

namespace Inilim\Tool\Method\Arr;

function isList(array $array): bool
{
    if (PHP_VERSION_ID >= 80100) {
        return \array_is_list($array);
    }

    if ([] === $array || $array === \array_values($array)) {
        return true;
    }

    $nextKey = -1;

    foreach ($array as $k => $v) {
        if ($k !== ++$nextKey) {
            return false;
        }
    }

    return true;
}
