<?php

namespace Inilim\Method\Json;

use Inilim\Tool\Json;

Json::__include('decode');

/**
 * @template T
 * @param T $default
 * @return string|T
 */
function tryDecodeAsString(?string $value, $default = null)
{
    if ($value === null) return $default;
    $value = \Inilim\Method\Json\decode($value);
    if (\is_string($value)) return $value;
    return $default;
}
