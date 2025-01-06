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
    $value = \Inilim\Tool\Method\Json\decode($value, false);
    if (\Inilim\Tool\Method\Json\hasError()) return null;
    return \Inilim\Tool\Method\Other\getType($value);
}
