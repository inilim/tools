<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Fill in data where it's missing.
 * @template T of array|object
 * @return \Closure(T &$target, string|string[] $key, mixed $value):T
 */
function dataFill()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (&$target, $key, $value) {
        return \Inilim\Tool\Method\Arr\dataSet()($target, $key, $value, false);
    };
}
