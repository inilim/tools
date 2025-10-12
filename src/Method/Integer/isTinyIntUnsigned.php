<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * @param mixed $value
 */
function isTinyIntUnsigned($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\Inilim\Tool\Method\Integer\lenNumeric($value) > \Inilim\Tool\Integer::TINY_INT_UNSIGNED_MAX_LENGHT) return false;

    return \Inilim\Tool\Method\Integer\checkBetween(
        $value,
        \Inilim\Tool\Integer::TINY_INT_UNSIGNED_MIN,
        \Inilim\Tool\Integer::TINY_INT_UNSIGNED_MAX
    );
}
