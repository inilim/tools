<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 */
function checkLenMax($num, $max): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }

    return \Inilim\Tool\Method\Integer\checkMax(
        \Inilim\Tool\Method\Integer\lenNumeric($num),
        $max
    );
}
