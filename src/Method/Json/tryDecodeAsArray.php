<?php

namespace Inilim\Tool\Method\Json;

/**
 * object to array
 * 
 * @template T
 * @param T $default
 * @return mixed[]|T
 */
function tryDecodeAsArray(?string $v, $default = null)
{
    if ($v === null) return $default;
    $v = \Inilim\Tool\Method\Json\decode($v, true);
    if (\is_array($v)) return $v;
    return $default;
}
