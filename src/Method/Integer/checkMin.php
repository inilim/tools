<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 * @return bool
 */
function checkMin($num, $min)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!isNumeric($min)) {
        throw new \InvalidArgumentException('$min must be numeric');
    }

    return \intval($num) >= \intval($min);
}
