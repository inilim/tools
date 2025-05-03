<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param mixed $value
 */
function isTinyInt($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\Inilim\Tool\Method\Integer\lenNumeric($value) > \Inilim\Tool\Integer::TINY_INT_MAX_LENGHT) return false;
    return checkBetween(
        $value,
        \Inilim\Tool\Integer::TINY_INT_MIN,
        \Inilim\Tool\Integer::TINY_INT_MAX
    );
}
