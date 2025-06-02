<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * set if null OR empty string OR empty array
 * @return \Closure(array &$array, string $key, mixed $value):bool
 */
function setValueIfEmpty(): \CLosure
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException('setValueIfEmpty()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, string $key, $value): bool {
        $cur = \Inilim\Tool\Method\Arr\get($array, $key, -1);
        if (\in_array($cur, [null, '', []], true)) {
            \Inilim\Tool\Method\Arr\set()($array, $key, $value);
            return true;
        }
        return false;
    };
}
