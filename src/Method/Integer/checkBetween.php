<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $fromTo
 * @param numeric-string|int $toFrom
 */
function checkBetween($num, $fromTo, $toFrom): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!\Inilim\Tool\Method\Integer\isNumeric($fromTo)) {
        throw new \InvalidArgumentException('$fromTo must be numeric');
    }
    if (!\Inilim\Tool\Method\Integer\isNumeric($toFrom)) {
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
