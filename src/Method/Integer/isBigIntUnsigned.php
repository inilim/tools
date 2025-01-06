<?php

namespace Inilim\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    '__compare',
]);
\Inilim\Tool\Str::__include('__startsWith');

/**
 * 0 <> 18446744073709551615
 * @param mixed $value
 * @return bool
 */
function isBigIntUnsigned($value)
{
    if (!\Inilim\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\Inilim\Method\String\__startsWith($value, '-')) return false;
    $len = \strlen(\ltrim($value, '-'));
    if ($len < Integer::BIG_INT_MAX_UNSIGNED_LENGHT) return true;
    if ($len > Integer::BIG_INT_MAX_UNSIGNED_LENGHT) return false;
    // длина 20
    return \Inilim\Method\Integer\__compare(\str_split($value), [1, 8, 4, 4, 6, 7, 4, 4, 0, 7, 3, 7, 0, 9, 5, 5, 1, 6, 1, 5]);
}
