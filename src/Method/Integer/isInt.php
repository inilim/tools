<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * -2147483648 <> 2147483647
 * @param mixed $value
 */
function isInt($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|string $value */
    $value = \strval($value);
    /** @var string $value */
    $len = \Inilim\Tool\Method\Integer\lenNumeric($value);
    if ($len < \Inilim\Tool\Integer::MAX_LEN_32_BIT) return true;
    if ($len > \Inilim\Tool\Integer::MAX_LEN_32_BIT) return false;
    // длина 10
    $last = \Inilim\Tool\Method\PF\str_starts_with($value, '-') ? 8 : 7;
    return \Inilim\Tool\Method\Integer\__compare(\str_split(\ltrim($value, '-')), [2, 1, 4, 7, 4, 8, 3, 6, 4, $last]);
}
