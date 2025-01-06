<?php

namespace Inilim\Tool\Method\Json;

use Inilim\Tool\Json;

Json::__include('decode');

/**
 * @template T
 * @param T $default
 * @return int|T
 */
function tryDecodeAsInteger(?string $value, $default = null)
{
    if ($value === null) return $default;
    $value = \Inilim\Tool\Method\Json\decode($value);
    if (\is_int($value)) return $value;
    return $default;
}
