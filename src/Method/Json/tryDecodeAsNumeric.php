<?php

namespace Inilim\Tool\Method\Json;

/**
 * @template T of mixed
 * @param T $default
 * @return int|float|numeric-string|T
 */
function tryDecodeAsNumeric(?string $v, $default = null)
{
    if ($v === null) {
        return $default;
    }
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\is_numeric($v)) {
        return $v;
    }
    return $default;
}
