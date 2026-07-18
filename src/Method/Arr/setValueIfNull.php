<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * установить значение если значение по ключу null
 * @return \Closure(array &$array, string|int $key, mixed $value):bool
 */
function setValueIfNull(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (array &$array, $key, $value): bool {
        if (\Inilim\Tool\Method\LarArr\has($array, $key) && \Inilim\Tool\Method\LarArr\get($array, $key) === null) {
            \Inilim\Tool\Method\LarArr\set()($array, $key, $value);
            return true;
        }
        return false;
    };
}
