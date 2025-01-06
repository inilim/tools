<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $num
 * @return bool
 */
function checkBetween($num, int $fromTo, int $toFrom)
{
    if (\is_string($num) && !\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }

    $v = \intval($num);

    if ($fromTo > $toFrom) {
        list($toFrom, $fromTo) = [$fromTo, $toFrom];
    }
    return $v >= $fromTo && $v <= $toFrom;
}
