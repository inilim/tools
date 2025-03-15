<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 * @return bool
 */
function checkLenMin($num, $min)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }

    return \Inilim\Tool\Method\Integer\checkMin(
        \Inilim\Tool\Method\Integer\lenNumeric($num),
        $min
    );
}
