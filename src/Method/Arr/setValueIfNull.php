<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * установить значение если значение по ключу null
 * @return \Closure(array &$array, string|int $key, mixed $value):bool
 */
function setValueIfNull()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, $key, $value) {
        if (\Inilim\Tool\Method\Arr\has($array, $key) && \Inilim\Tool\Method\Arr\get($array, $key) === null) {
            \Inilim\Tool\Method\Arr\set()($array, $key, $value);
            return true;
        }
        return false;
    };
}
