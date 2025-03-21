<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Fill in data where it's missing.
 * @template T of array|object
 * @return \Closure(T &$target, string|string[] $key, mixed $value):T
 */
function dataFill()
{
    return static function (&$target, $key, $value) {
        return \Inilim\Tool\Method\Arr\dataSet()($target, $key, $value, false);
    };
}
