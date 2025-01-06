<?php

namespace Inilim\Tool\Method\Arr;

\Inilim\Tool\Arr::__include([
    'dataGet',
    'getDotKeys',
    'dot',
    'only',
    'undot',
]);
\Inilim\Tool\Str::__include('contains');

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

    if (\is_array($key) || \is_int($key) || !\Inilim\Tool\Method\String\contains($key, '*')) {
        return \Inilim\Tool\Method\Arr\dataGet($target, $key, $default);
    }

    $keys = \Inilim\Tool\Method\Arr\getDotKeys($target, $key);

    if (!$keys) {
        return $default;
    }

    return \Inilim\Tool\Method\Arr\dataGet(
        \Inilim\Tool\Method\Arr\undot(\Inilim\Tool\Method\Arr\only(\Inilim\Tool\Method\Arr\dot($target), $keys)),
        $key,
        $default
    );
}
