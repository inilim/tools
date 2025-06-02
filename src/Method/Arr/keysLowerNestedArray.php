<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @param array $array
 * @return array
 */
function keysLowerNestedArray(array $array, int $depth = 1)
{
    return \Inilim\Tool\Method\Arr\nestedMap(
        $array,
        $depth,
        static function (array $value) {
            return \Inilim\Tool\Method\Arr\keysLower($value);
        }
    );
}
