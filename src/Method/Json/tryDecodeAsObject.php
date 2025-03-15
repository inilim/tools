<?php

namespace Inilim\Tool\Method\Json;

/**
 * @template T of mixed
 * @param T $default
 * @return object|T
 */
function tryDecodeAsObject(?string $v, $default = null)
{
    if ($v === null) return $default;
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\is_object($v)) return $v;
    return $default;
}
