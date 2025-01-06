<?php

namespace Inilim\Method\Json;

use Inilim\Tool\Json;

Json::__include([
    'decode',
    'hasError',
]);

/**
 * @return bool
 */
function isJsonAsArrOrObj(?string $value)
{
    if ($value === null) return false;

    $value = \Inilim\Method\Json\decode($value);
    if (\Inilim\Method\Json\hasError()) return false;

    return \is_array($value) || \is_object($value);
}
