<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'lenNumeric',
    '__compare',
]);
\Inilim\Tool\Str::__include('__startsWith');

/**
 * -9223372036854775808 <> 9223372036854775807
 * @param mixed $value
 * @return bool
 */
function isBigInt($value)
{
    if (!isNumeric($value)) return false;
    /** @var int|string $value */
    $value = \strval($value);
    /** @var string $value */
    $len = lenNumeric($value);
    if ($len < Integer::BIG_INT_MAX_LENGHT) return true;
    if ($len > Integer::BIG_INT_MAX_LENGHT) return false;
    // длина 19
    $last = \Inilim\Tool\Method\String\__startsWith($value, '-') ? 8 : 7;
    return __compare(\str_split(\trim($value, '-')), [9, 2, 2, 3, 3, 7, 2, 0, 3, 6, 8, 5, 4, 7, 7, 5, 8, 0, $last]);
}
