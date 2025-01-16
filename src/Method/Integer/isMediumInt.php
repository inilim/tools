<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'lenNumeric',
    'checkBetween',
]);

/**
 * @param mixed $v
 * @return bool
 */
function isMediumInt($v)
{
    if (!isNumeric($v)) return false;
    /** @var int|float|string $v */
    $v = \strval($v);
    /** @var string $v */
    if (lenNumeric($v) > Integer::MEDIUM_INT_MAX_LENGHT) return false;
    return checkBetween($v, Integer::MEDIUM_INT_MIN, Integer::MEDIUM_INT_MAX);
}
