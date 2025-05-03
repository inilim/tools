<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 */
function checkMin($num, $min): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!\Inilim\Tool\Method\Integer\isNumeric($min)) {
        throw new \InvalidArgumentException('$min must be numeric');
    }

    return \intval($num) >= \intval($min);
}
