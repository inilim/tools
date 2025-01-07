<?php

namespace Inilim\Tool\Method\Json;

\Inilim\Tool\Json::__include([
    'decode',
    'hasError',
]);

function isJsonAsFloat(?string $value): bool
{
    if ($value === null) return false;
    $value = decode($value);
    if (hasError()) return false;
    return \is_float($value);
}
