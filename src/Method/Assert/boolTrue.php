<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert true $value
 * @phpstan-assert true $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
function boolTrue($value, string $message = '')
{
    if ($value !== true) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a value to be true. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
