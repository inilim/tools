<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $num1
 * @param numeric-string|int $num2
 * @return bool
 */
function equals($num1, $num2)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num1) || !\Inilim\Tool\Method\Integer\isNumeric($num2)) {
        throw new \InvalidArgumentException('Give not numeric');
    }

    return \intval($num1) === \intval($num2);
}
