<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'checkBetween',
]);

/**
 * @return bool
 */
function isMediumInt(mixed $value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (\strlen(\ltrim($value, '-')) > Integer::MEDIUM_INT_MAX_LENGHT) return false;
    return \Inilim\Tool\Method\Integer\checkBetween($value, Integer::MEDIUM_INT_MIN, Integer::MEDIUM_INT_MAX);
}
