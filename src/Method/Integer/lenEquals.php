<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include([
    'equals',
    'isNumeric',
    'lenNumeric',
]);

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $equal
 * @return bool
 */
function lenEquals($num, $equal)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!isNumeric($equal)) {
        throw new \InvalidArgumentException('$equal must be numeric');
    }

    return equals(
        lenNumeric($num),
        lenNumeric($equal),
    );
}
