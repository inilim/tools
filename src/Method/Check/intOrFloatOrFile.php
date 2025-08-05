<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true int|float|string $value
 * @phpstan-assert-if-true int|float|string $value
 * 
 * @param mixed  $value
 */
function intOrFloatOrFile($value): bool
{
    return \Inilim\Tool\Method\Check\intOrFloat($value) || \Inilim\Tool\Method\Check\file($value);
}
