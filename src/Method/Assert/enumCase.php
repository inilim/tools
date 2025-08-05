<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * @psalm-assert \UnitEnum $value
 * @phpstan-assert \UnitEnum $value
 * 
 * 
 * @param mixed $value
 * @return void
 * @throws \InvalidArgumentException
 */
function enumCase($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\enumCase($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected an \UnitEnum. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
