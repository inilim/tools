<?php

namespace Inilim\Tool\Method\Arr;

\Inilim\Tool\Arr::__include('dataSet');

/**
 * Fill in data where it's missing.
 * @param  mixed  $target
 * @param  string|string[]  $key
 * @param  mixed  $value
 * @return mixed
 */
function dataFill(&$target, $key, $value)
{
    return \Inilim\Tool\Method\Arr\dataSet($target, $key, $value, false);
}
