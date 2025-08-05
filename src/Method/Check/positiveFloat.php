<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @psalm-pure
 * @psalm-assert-if-true float $value
 * @phpstan-assert-if-true float $value
 * @param mixed  $value
 */
function positiveFloat($value): bool
{
    return \is_float($value) && $value > 0;
}
