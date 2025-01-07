<?php

namespace Inilim\Tool\Method\Json;

\Inilim\Tool\Json::__include('decode');
\Inilim\Tool\Arr::__include('isList');

/**
 * @template T
 * @param T $default
 * @return list<mixed>|T
 */
function tryDecodeAsArrList(?string $value, $default = null)
{
    if ($value === null) return $default;
    $value = decode($value);
    if (\is_array($value) && \Inilim\Tool\Method\Arr\isList($value)) return $value;
    return $default;
}
