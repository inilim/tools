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
function isMediumInt(mixed $value): bool
{
    if (!isNumeric($value)) return false;
    /** @var int|float|string $value */
    $value = \strval($value);
    /** @var string $value */
    if (lenNumeric($value) > Integer::MEDIUM_INT_MAX_LENGHT) return false;
    return checkBetween($value, Integer::MEDIUM_INT_MIN, Integer::MEDIUM_INT_MAX);
}
