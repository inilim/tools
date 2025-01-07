<?php

namespace Inilim\Tool\Method\Json;

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
    $value = decode($value);
    if (
        hasError()
        || !\is_array($value)
        || !\Inilim\Tool\Method\Arr\isList($value)
    ) return false;
    return true;
}
