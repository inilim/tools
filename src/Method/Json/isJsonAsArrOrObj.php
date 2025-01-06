<?php

namespace Inilim\Tool\Method\Json;

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

    $value = \Inilim\Tool\Method\Json\decode($value);
    if (\Inilim\Tool\Method\Json\hasError()) return false;

    return \is_array($value) || \is_object($value);
}
