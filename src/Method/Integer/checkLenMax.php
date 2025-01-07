<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include([
    'isNumeric',
    'lenNumeric',
    'checkMax',
]);

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 * @return bool
 */
function checkLenMax($num, $max)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }

    return checkMax(
        lenNumeric($num),
        $max
    );
}
