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
    $value = \Inilim\Tool\Method\Json\decode($value);
    if (
        \Inilim\Tool\Method\Json\hasError()
        || !\is_array($value)
        || !\Inilim\Tool\Method\Arr\isList($value)
    ) return false;
    return true;
}
