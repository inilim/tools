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
    if (!\Inilim\Tool\Method\Integer\isNumeric($num1)) {
        throw new \InvalidArgumentException('$num1 must be numeric');
    } elseif (!\Inilim\Tool\Method\Integer\isNumeric($num2)) {
        throw new \InvalidArgumentException('$num2 must be numeric');
    }

    return \intval($num1) === \intval($num2);
}
