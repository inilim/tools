<?php

namespace Inilim\Tool\Method\Json;

/**
 * @template T of mixed
 * @param T $default
 * @return float|T
 */
function tryDecodeAsFloat(?string $v, $default = null)
{
    if ($v === null) return $default;
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\is_float($v)) return $v;
    return $default;
}
