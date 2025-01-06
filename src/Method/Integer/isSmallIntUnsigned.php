<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'checkBetween',
]);

/**
 */
function isSmallIntUnsigned(mixed $value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\strlen(\ltrim($value, '-')) > Integer::SMALL_INT_UNSIGNED_MAX_LENGHT) return false;
    return \Inilim\Tool\Method\Integer\checkBetween($value, Integer::SMALL_INT_UNSIGNED_MIN, Integer::SMALL_INT_UNSIGNED_MAX);
}
