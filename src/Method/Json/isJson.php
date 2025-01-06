<?php

namespace Inilim\Method\Json;

use Inilim\Tool\Json;

Json::__include([
    'decode',
    'hasError',
]);

function isJson(?string $value): bool
{
    if ($value === null) return false;
    \Inilim\Method\Json\decode($value);
    return !\Inilim\Method\Json\hasError();
}
