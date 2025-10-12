<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num1
 * @param numeric-string|int $num2
 */
function equals($num1, $num2): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num1)) {
        throw new \InvalidArgumentException('$num1 must be numeric');
    }
    if (!\Inilim\Tool\Method\Integer\isNumeric($num2)) {
        throw new \InvalidArgumentException('$num2 must be numeric');
    }

    return \intval($num1) === \intval($num2);
}
