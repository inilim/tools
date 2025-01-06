<?php

namespace Inilim\Tool\Method\Integer;

/**
 * Clamp the given number between the given minimum and maximum.
 * @param int|float $number
 * @param int|float $min
 * @param int|float $max
 * @return int|float
 */
function clamp($number, $min, $max)
{
    return \min(\max($number, $min), $max);
}
