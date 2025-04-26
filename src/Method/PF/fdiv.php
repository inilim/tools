<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @return float
 */
function fdiv(float $dividend, float $divisor)
{
    if (\Inilim\Tool\Method\Check\php80()) {
        return \fdiv($dividend, $divisor);
    }
    return @($dividend / $divisor);
}
