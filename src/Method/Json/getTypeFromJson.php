<?php

namespace Inilim\Method\Json;

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
    $value = \Inilim\Method\Json\decode($value, false);
    if (\Inilim\Method\Json\hasError()) return null;
    return \Inilim\Method\Other\getType($value);
}
