<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    '__compare',
]);
\Inilim\Tool\Str::__include('__startsWith');

/**
 * -2147483648 <> 2147483647
 * @param mixed $value
 * @return bool
 */
function isInt($value)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|string $value */
    $value = \strval($value);
    /** @var string $value */
    $len = \strlen(\ltrim($value, '-'));
    if ($len < Integer::MAX_LEN_32_BIT) return true;
    if ($len > Integer::MAX_LEN_32_BIT) return false;
    // длина 10
    $last = \Inilim\Tool\Method\String\__startsWith($value, '-') ? 8 : 7;
    return \Inilim\Tool\Method\Integer\__compare(\str_split(\ltrim($value, '-')), [2, 1, 4, 7, 4, 8, 3, 6, 4, $last]);
}
