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
    $value = \Inilim\Tool\Method\Json\decode($value);
    if (\Inilim\Tool\Method\Json\hasError()) return false;
    return \is_int($value);
}
