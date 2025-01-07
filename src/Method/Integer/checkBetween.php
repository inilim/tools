<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $fromTo
 * @param numeric-string|int $toFrom
 * @return bool
 */
function checkBetween($num, $fromTo, $toFrom)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!isNumeric($fromTo)) {
        throw new \InvalidArgumentException('$fromTo must be numeric');
    }
    if (!isNumeric($toFrom)) {
        throw new \InvalidArgumentException('$toFrom must be numeric');
    }

    $toFrom = \intval($toFrom);
    $fromTo = \intval($fromTo);
    $num    = \intval($num);

    if ($fromTo > $toFrom) {
        list($toFrom, $fromTo) = [$fromTo, $toFrom];
    }
    return $num >= $fromTo && $num <= $toFrom;
}
