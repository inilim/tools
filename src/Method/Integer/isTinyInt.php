<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'lenNumeric',
    'checkBetween',
]);

/**
 * @param mixed $value
 * @return bool
 */
function isTinyInt($value)
{
    if (!isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (lenNumeric($value) > Integer::TINY_INT_MAX_LENGHT) return false;
    return checkBetween($value, Integer::TINY_INT_MIN, Integer::TINY_INT_MAX);
}
