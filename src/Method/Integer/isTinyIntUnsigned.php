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
function isTinyIntUnsigned($value)
{
    if (!isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (lenNumeric($value) > Integer::TINY_INT_UNSIGNED_MAX_LENGHT) return false;

    return checkBetween($value, Integer::TINY_INT_UNSIGNED_MIN, Integer::TINY_INT_UNSIGNED_MAX);
}
