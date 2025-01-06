<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('dataSet');

/**
 * Fill in data where it's missing.
 * @param  mixed  $target
 * @param  string|string[]  $key
 * @param  mixed  $value
 * @return mixed
 */
function dataFill(&$target, $key, $value)
{
    return \Inilim\Method\Arr\dataSet($target, $key, $value, false);
}
