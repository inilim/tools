<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 */
function isNegative($num): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('Give not numeric');
    }
    return \intval($num) < 0;
}
