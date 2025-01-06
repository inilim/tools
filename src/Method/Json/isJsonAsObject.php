<?php

namespace Inilim\Method\Json;

\Inilim\Tool\Json::__include([
    'decode',
    'hasError',
]);

/**
 * @return bool
 */
function isJsonAsObject(?string $value)
{
    if ($value === null) return false;
    $value = \Inilim\Method\Json\decode($value);
    if (\Inilim\Method\Json\hasError()) return false;
    return \is_object($value);
}
