<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    '__compare',
]);
\Inilim\Tool\Str::__include('__startsWith');

/**
 * 0 <> 4_294_967_295
 * @param mixed $value
 * @return bool
 */
function isIntUnsigned($value)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\Inilim\Tool\Method\String\__startsWith($value, '-')) return false;
    $len = \strlen(\ltrim($value, '-'));
    if ($len < Integer::MAX_LEN_32_BIT) return true;
    if ($len > Integer::MAX_LEN_32_BIT) return false;
    // длина 10
    return \Inilim\Tool\Method\Integer\__compare(\str_split($value), [4, 2, 9, 4, 9, 6, 7, 2, 9, 5]);
}
