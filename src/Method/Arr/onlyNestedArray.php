<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @param  (string|int)[]|string|int $keys
 * @return array
 */
function onlyNestedArray(array $array, $keys, int $depth = 1)
{
    return \Inilim\Tool\Method\Arr\nestedMap(
        $array,
        $depth,
        static function (array $value) use ($keys) {
            return \Inilim\Tool\Method\Arr\only($value, $keys);
        }
    );
}
