<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Str;

Arr::__include([
    'dataGet',
    'getDotKeys',
    'dot',
    'only',
    'undot',
]);
Str::__include('contains');

/**
 * alternate dataGet
 *
 * @param  mixed  $target
 * @param  string|array|int|null  $key
 * @param  mixed  $default
 * @return mixed
 */
function dataGet2($target, $key, $default = null)
{
    if ($key === null) {
        return $target;
    }

    if (\is_array($key) || \is_int($key) || !\Inilim\Method\String\contains($key, '*')) {
        return \Inilim\Method\Arr\dataGet($target, $key, $default);
    }

    $keys = \Inilim\Method\Arr\getDotKeys($target, $key);

    if (!$keys) {
        return $default;
    }

    return \Inilim\Method\Arr\dataGet(
        \Inilim\Method\Arr\undot(\Inilim\Method\Arr\only(\Inilim\Method\Arr\dot($target), $keys)),
        $key,
        $default
    );
}
