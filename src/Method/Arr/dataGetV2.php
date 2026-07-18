<?php

declare(strict_types=1);

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
        return \Inilim\Tool\Method\Lar\dataGet($target, $key, $default);
    }

    $keys = \Inilim\Tool\Method\Arr\dotKeysByPattern($target, $key);

    if (!$keys) {
        return \Inilim\Tool\Method\Lar\value($default);
    }

    return \Inilim\Tool\Method\Lar\dataGet(
        \Inilim\Tool\Method\LarArr\undot(\Inilim\Tool\Method\LarArr\only(\Inilim\Tool\Method\LarArr\dot($target), $keys)),
        $key,
        $default
    );
}
