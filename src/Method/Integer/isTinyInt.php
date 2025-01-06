<?php

namespace Inilim\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'checkBetween',
]);

/**
 * @param mixed $value
 * @return bool
 */
function isTinyInt($value)
{
    if (!\Inilim\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\strlen(\ltrim($value, '-')) > Integer::TINY_INT_MAX_LENGHT) return false;
    return \Inilim\Method\Integer\checkBetween($value, Integer::TINY_INT_MIN, Integer::TINY_INT_MAX);
}
