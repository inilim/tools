<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * 0 <> 4_294_967_295
 * @param mixed $value
 */
function isIntUnsigned($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\Inilim\Tool\Method\PF\str_starts_with($value, '-')) return false;
    $len = \Inilim\Tool\Method\Integer\lenNumeric($value);
    if ($len < \Inilim\Tool\Integer::MAX_LEN_32_BIT) return true;
    if ($len > \Inilim\Tool\Integer::MAX_LEN_32_BIT) return false;
    // длина 10
    return \Inilim\Tool\Method\Integer\__compare(\str_split($value), [4, 2, 9, 4, 9, 6, 7, 2, 9, 5]);
}
