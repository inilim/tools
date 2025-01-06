<?php

namespace Inilim\Method\Integer;

use Inilim\Tool\Integer;

// \Inilim\Method\Integer\

Integer::__include([
    'isNumeric',
    'checkBetween',
]);

/**
 * @return bool
 */
function isTinyIntUnsigned(mixed $value)
{
    if (!\Inilim\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\strlen(\ltrim($value, '-')) > Integer::TINY_INT_UNSIGNED_MAX_LENGHT) return false;

    return \Inilim\Method\Integer\checkBetween($value, Integer::TINY_INT_UNSIGNED_MIN, Integer::TINY_INT_UNSIGNED_MAX);
}
