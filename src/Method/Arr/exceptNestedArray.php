<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @param  (string|int)[]|string|int $keys
 * @return array
 */
function exceptNestedArray(array $array, $keys, int $depth = 1): array
{
    return \Inilim\Tool\Method\Arr\nestedMap(
        $array,
        $depth,
        static function ($value) use ($keys) {
            return \Inilim\Tool\Method\Arr\except($value, $keys);
        }
    );
}
