<?php

namespace Inilim\Method\Json;

\Inilim\Tool\Json::__include([
    'decode',
    'hasError',
]);

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @return bool
 */
function isJsonAsNumeric(?string $value)
{
    if ($value === null) return false;
    $value = \Inilim\Method\Json\decode($value);
    if (\Inilim\Method\Json\hasError()) return false;

    return \Inilim\Method\Integer\isNumeric($value);
}
