<?php

namespace Inilim\Method\Json;

\Inilim\Tool\Json::__include([
    'decode',
    'hasError',
]);

function isJsonAsFloat(?string $value): bool
{
    if ($value === null) return false;
    $value = \Inilim\Method\Json\decode($value);
    if (\Inilim\Method\Json\hasError()) return false;
    return \is_float($value);
}
