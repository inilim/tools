<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 * @return bool
 */
function checkMax($num, $max)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!\Inilim\Tool\Method\Integer\isNumeric($max)) {
        throw new \InvalidArgumentException('$max must be numeric');
    }

    return \intval($num) <= \intval($max);
}
