<?php

namespace Inilim\Tool\Method\Integer;

/**
 * -9223372036854775808 <> 9223372036854775807
 * @param mixed $value
 */
function isBigInt($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|string $value */
    $value = \strval($value);
    /** @var string $value */
    $len = \Inilim\Tool\Method\Integer\lenNumeric($value);
    if ($len < \Inilim\Tool\Integer::BIG_INT_MAX_LENGHT) return true;
    if ($len > \Inilim\Tool\Integer::BIG_INT_MAX_LENGHT) return false;
    // длина 19
    $last = \Inilim\Tool\Method\Str\startsWith($value, '-') ? 8 : 7;
    return \Inilim\Tool\Method\Integer\__compare(\str_split(\trim($value, '-')), [9, 2, 2, 3, 3, 7, 2, 0, 3, 6, 8, 5, 4, 7, 7, 5, 8, 0, $last]);
}
