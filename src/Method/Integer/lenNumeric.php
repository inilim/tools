<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include([
    'isNumeric',
    'lenNumeric',
    'abs',
]);

/**
 * @param numeric-string|int $num
 * @return int
 */
function lenNumeric($num)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    return \strlen(\strval(abs($num)));
}
