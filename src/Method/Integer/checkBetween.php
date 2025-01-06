<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $value
 * @return bool
 */
function checkBetween($value, int $fromTo, int $toFrom)
{
    if (\is_string($value) && !\Inilim\Tool\Method\Integer\isNumeric($value)) {
        throw new \TypeError('bad value: ' . $value);
    }

    $v = \intval($value);

    if ($fromTo > $toFrom) {
        list($toFrom, $fromTo) = [$fromTo, $toFrom];
    }
    return $v >= $fromTo && $v <= $toFrom;
}
