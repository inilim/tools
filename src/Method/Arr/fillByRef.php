<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @return \Closure(array &$array, int $count, mixed $value):void
 */
function fillByRef(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());
    return static function (array &$array, int $count, $value) {
        for ($i = 0; $i < $count; $i++) {
            $array[] = $value;
        }
    };
}
