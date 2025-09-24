<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 */
function fpow(float $num, float $exponent): float
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \fpow($num, $exponent);
    }

    return $num ** $exponent;
}
