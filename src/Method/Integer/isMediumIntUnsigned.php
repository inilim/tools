<?php

namespace Inilim\Tool\Method\Integer;

function isMediumIntUnsigned(mixed $value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\Inilim\Tool\Method\Integer\lenNumeric($value) > \Inilim\Tool\Integer::MEDIUM_INT_UNSIGNED_MAX_LENGHT) return false;
    return \Inilim\Tool\Method\Integer\checkBetween(
        $value,
        \Inilim\Tool\Integer::MEDIUM_INT_UNSIGNED_MIN,
        \Inilim\Tool\Integer::MEDIUM_INT_UNSIGNED_MAX
    );
}
