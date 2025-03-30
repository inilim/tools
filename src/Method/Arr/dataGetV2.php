<?php

namespace Inilim\Tool\Method\Arr;

/**
 * alternate dataGet
 * @author inilim
 * @param array|object $target
 * @param string|array|int|null $key
 * @param mixed $default
 * @return mixed
 */
function dataGetV2($target, $key, $default = null)
{
    if ($key === null) {
        return $target;
    }

    if (\is_array($key) || \is_int($key) || !\Inilim\Tool\Method\Str\contains($key, '*')) {
        return \Inilim\Tool\Method\Arr\dataGet($target, $key, $default);
    }

    $keys = \Inilim\Tool\Method\Arr\dotKeysByPattern($target, $key);

    if (!$keys) {
        return $default;
    }

    return \Inilim\Tool\Method\Arr\dataGet(
        \Inilim\Tool\Method\Arr\undot(\Inilim\Tool\Method\Arr\only(\Inilim\Tool\Method\Arr\dot($target), $keys)),
        $key,
        $default
    );
}
