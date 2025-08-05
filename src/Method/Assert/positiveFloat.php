<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert float $value
 * @phpstan-assert float $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function positiveFloat($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\positiveFloat($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a positive float. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
