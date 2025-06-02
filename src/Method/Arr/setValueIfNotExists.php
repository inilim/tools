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
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException('setValueIfNotExists()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, string $key, $value): bool {
        if (!\Inilim\Tool\Method\Arr\has($array, $key)) {
            \Inilim\Tool\Method\Arr\set()($array, $key, $value);
            return true;
        }
        return false;
    };
}
