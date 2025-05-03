<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

function fdiv(float $dividend, float $divisor): float
{
    if (\Inilim\Tool\Method\Check\php80()) {
        return \fdiv($dividend, $divisor);
    }
    return (float)@($dividend / $divisor);
}
