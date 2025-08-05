<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int<1,max>|float $value
 * @phpstan-assert int<1,max>|float $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function positiveFloatOrInt($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\positiveFloatOrInt($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a positive float or integer. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
