<?php

namespace Inilim\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $value
 * @return bool
 */
function checkBetween($value, int $fromTo, int $toFrom)
{
    if (\is_string($value) && !\Inilim\Method\Integer\isNumeric($value)) {
        throw new \TypeError('bad value: ' . $value);
    }

    $v = \intval($value);

    if ($fromTo > $toFrom) {
        list($toFrom, $fromTo) = [$fromTo, $toFrom];
    }
    return $v >= $fromTo && $v <= $toFrom;
}
