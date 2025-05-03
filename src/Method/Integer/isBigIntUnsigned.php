<?php

namespace Inilim\Tool\Method\Integer;

/**
 * 0 <> 18446744073709551615
 * @param mixed $value
 */
function isBigIntUnsigned($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\Inilim\Tool\Method\PF\str_starts_with($value, '-')) return false;
    $len = lenNumeric($value);
    if ($len < \Inilim\Tool\Integer::BIG_INT_MAX_UNSIGNED_LENGHT) return true;
    if ($len > \Inilim\Tool\Integer::BIG_INT_MAX_UNSIGNED_LENGHT) return false;
    // длина 20
    return \Inilim\Tool\Method\Integer\__compare(\str_split($value), [1, 8, 4, 4, 6, 7, 4, 4, 0, 7, 3, 7, 0, 9, 5, 5, 1, 6, 1, 5]);
}
