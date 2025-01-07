<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'lenNumeric',
    'checkBetween',
]);

/**
 */
function isSmallIntUnsigned(mixed $value): bool
{
    if (!isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (lenNumeric($value) > Integer::SMALL_INT_UNSIGNED_MAX_LENGHT) return false;
    return checkBetween($value, Integer::SMALL_INT_UNSIGNED_MIN, Integer::SMALL_INT_UNSIGNED_MAX);
}
