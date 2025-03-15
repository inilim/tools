<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @return bool
 */
function isNegative($num)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('Give not numeric');
    }
    return \intval($num) < 0;
}
