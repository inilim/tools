<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include([
    'isNumeric',
    'lenNumeric',
    'checkMin',
]);

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 * @return bool
 */
function checkLenMin($num, $min)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }

    return checkMin(
        lenNumeric($num),
        $min
    );
}
