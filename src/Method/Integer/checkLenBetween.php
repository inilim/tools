<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $fromTo
 * @param numeric-string|int $toFrom
 */
function checkLenBetween($num, $fromTo, $toFrom): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    return \Inilim\Tool\Method\Integer\checkBetween(
        \Inilim\Tool\Method\Integer\lenNumeric($num),
        $fromTo,
        $toFrom
    );
}
