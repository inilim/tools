<?php

namespace Inilim\Tool\Method\Json;

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
    $value = \Inilim\Tool\Method\Json\decode($value);
    if (\Inilim\Tool\Method\Json\hasError()) return false;

    return \Inilim\Tool\Method\Integer\isNumeric($value);
}
