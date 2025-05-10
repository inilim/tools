<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Remove any trailing zero digits after the decimal point of the given number.
 * @param  int|float  $number
 * @return int|float
 */
function trim($number)
{
    return \json_decode(\json_encode($number));
}
