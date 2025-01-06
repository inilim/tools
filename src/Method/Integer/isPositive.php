<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $num
 * @return bool
 */
function isPositive($num)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('Give not numeric');
    }
    return \intval($num) > 0;
}
