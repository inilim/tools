<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 */
function lenNumeric($num): int
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    return \strlen(\ltrim(\strval($num), '-'));
}
