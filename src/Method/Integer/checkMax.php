<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 * @return bool
 */
function checkMax($num, $max)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!isNumeric($max)) {
        throw new \InvalidArgumentException('$max must be numeric');
    }

    return \intval($num) <= \intval($max);
}
