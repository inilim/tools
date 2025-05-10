<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Convert the number to its human-readable equivalent.
 *
 * @param  int|float  $number
 * @return bool|string
 */
function abbreviate($number, int $precision = 0, ?int $maxPrecision = null)
{
    return \Inilim\Tool\Method\Integer\forHumans($number, $precision, $maxPrecision, true);
}
