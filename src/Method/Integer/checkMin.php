<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 * @return bool
 */
function checkMin($num, $min)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!\Inilim\Tool\Method\Integer\isNumeric($min)) {
        throw new \InvalidArgumentException('$min must be numeric');
    }

    return \intval($num) >= \intval($min);
}
