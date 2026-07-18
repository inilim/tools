<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use Lar::***
 * @author Laravel
 * Fill in data where it's missing.
 * @template T of array|object
 * @return \Closure(T &$target, string|string[] $key, mixed $value):T
 */
function dataFill(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (&$target, $key, $value) {
        return \Inilim\Tool\Method\Lar\dataSet()($target, $key, $value, false);
    };
}
