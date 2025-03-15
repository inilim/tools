<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $equal
 * @return bool
 */
function lenEquals($num, $equal)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }
    if (!\Inilim\Tool\Method\Integer\isNumeric($equal)) {
        throw new \InvalidArgumentException('$equal must be numeric');
    }

    return \Inilim\Tool\Method\Integer\equals(
        \Inilim\Tool\Method\Integer\lenNumeric($num),
        \Inilim\Tool\Method\Integer\lenNumeric($equal),
    );
}
