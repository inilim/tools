<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * установить значение если значения по ключу нет
 * @return \Closure(array &$array, string $key, mixed $value):bool
 */
function setValueIfNotExists(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (array &$array, string $key, $value): bool {
        if (!\Inilim\Tool\Method\LarArr\has($array, $key)) {
            \Inilim\Tool\Method\LarArr\set()($array, $key, $value);
            return true;
        }
        return false;
    };
}
