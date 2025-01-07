<?php

namespace Inilim\Tool\Method\Json;

\Inilim\Tool\Json::__include([
    'decode',
    'hasError',
]);

/**
 * @return bool
 */
function isJsonAsInteger(?string $value)
{
    if ($value === null) return false;
    $value = decode($value);
    if (hasError()) return false;
    return \is_int($value);
}
