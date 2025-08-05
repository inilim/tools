<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true int|float $value
 * @phpstan-assert-if-true int|float $value
 * 
 * @param mixed  $value
 */
function intOrFloat($value): bool
{
    return \is_int($value) || \is_float($value);
}
