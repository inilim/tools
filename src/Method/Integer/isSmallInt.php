<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'lenNumeric',
    'checkBetween',
]);

/**
 * @return bool
 */
function isSmallInt(mixed $value)
{
    if (!isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (lenNumeric($value) > Integer::SMALL_INT_MAX_LENGHT) return false;
    return checkBetween($value, Integer::SMALL_INT_MIN, Integer::SMALL_INT_MAX);
}
