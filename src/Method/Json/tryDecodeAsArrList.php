<?php

namespace Inilim\Method\Json;

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
    $value = \Inilim\Method\Json\decode($value);
    if (\is_array($value) && \Inilim\Method\Arr\isList($value)) return $value;
    return $default;
}
