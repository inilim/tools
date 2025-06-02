<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @param mixed[] $array
 * @return mixed[]
 */
function keysUpperNestedArray(array $array, int $depth = 1)
{
    return \Inilim\Tool\Method\Arr\nestedMap(
        $array,
        $depth,
        static function (array $value) {
            return \Inilim\Tool\Method\Arr\keysUpper($value);
        }
    );
}
