<?php

namespace Inilim\Tool\Method\Lar;

/**
 * Fill in data where it's missing.
 *
 * @return \Closure(mixed $target, string|array $key, mixed $value):mixed
 */
function dataFill(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (&$target, $key, $value) {
        return \Inilim\Tool\Method\Lar\dataSet()($target, $key, $value, false);
    };
}
