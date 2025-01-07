<?php

namespace Inilim\Tool\Method\Json;

use Inilim\Tool\Json;

Json::__include('decode');

/**
 * object to array
 * 
 * @template T
 * @param T $default
 * @return mixed[]|array{}|T
 */
function tryDecodeAsArray(?string $value, $default = null)
{
    if ($value === null) return $default;
    $value = decode($value, true);
    if (\is_array($value)) return $value;
    return $default;
}
