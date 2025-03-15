<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Fill in data where it's missing.
 * @template T of array|object
 * @param T $target
 * @param  string|string[]  $key
 * @param  mixed  $value
 * @return T
 */
function dataFill(&$target, $key, $value)
{
    return \Inilim\Tool\Method\Arr\dataSet($target, $key, $value, false);
}
