<?php

namespace Inilim\Tool\Method\Json;

use Inilim\Tool\Json;
use Inilim\Tool\Other;

Json::__include([
    'decode',
    'hasError',
]);
Other::__include('getType');

/**
 * gettype - вернет null если json не валидный
 */
function getTypeFromJson(?string $value): ?string
{
    if ($value === null) return null;
    $value = decode($value, false);
    if (hasError()) return null;
    return \Inilim\Tool\Method\Other\getType($value);
}
