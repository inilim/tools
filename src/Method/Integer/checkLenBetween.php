<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include([
    'checkBetween',
    'isNumeric',
    'lenNumeric',
]);

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $fromTo
 * @param numeric-string|int $toFrom
 * @return bool
 */
function checkLenBetween($num, $fromTo, $toFrom)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    return checkBetween(
        lenNumeric($num),
        $fromTo,
        $toFrom
    );
}
