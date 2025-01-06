<?php

namespace Inilim\Method\Json;

\Inilim\Tool\Json::__include([
    'decode',
    'hasError',
]);
\Inilim\Tool\Arr::__include('isList');

/**
 * @return bool
 */
function isJsonAsArrList(?string $value)
{
    if ($value === null) return false;
    $value = \Inilim\Method\Json\decode($value);
    if (
        \Inilim\Method\Json\hasError()
        || !\is_array($value)
        || !\Inilim\Method\Arr\isList($value)
    ) return false;
    return true;
}
