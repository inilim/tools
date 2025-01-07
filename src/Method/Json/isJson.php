<?php

namespace Inilim\Tool\Method\Json;

use Inilim\Tool\Json;

Json::__include([
    'decode',
    'hasError',
]);

function isJson(?string $value): bool
{
    if ($value === null) return false;
    decode($value);
    return !hasError();
}
