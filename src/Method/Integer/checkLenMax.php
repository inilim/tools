<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include([
    'isNumeric',
    'checkMax',
]);

/**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 * @return bool
 */
function checkLenMax($num, $max)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric');
    }

    return \Inilim\Tool\Method\Integer\checkMax(
        \strlen(\ltrim(\strval($num), '-')),
        $max
    );
}
