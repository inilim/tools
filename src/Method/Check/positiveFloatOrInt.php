<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @psalm-pure
 * @psalm-assert-if-true int<1,max>|float $value
 * @phpstan-assert-if-true int<1,max>|float $value
 * @param mixed  $value
 */
function positiveFloatOrInt($value): bool
{
    return (\is_int($value) || \is_float($value)) && $value > 0;
}
