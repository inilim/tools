<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * @param numeric-string|int $num
 * @return numeric-string|int
 */
function abs($num)
{
    if (!isNumeric($num)) {
        throw new \InvalidArgumentException('$num must be numeric-string|int');
    }
    if (\is_int($num)) {
        return \intval(\ltrim(\strval($num), '-'));
    }
    return \ltrim($num, '-');
}
