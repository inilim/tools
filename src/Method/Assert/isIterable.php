<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert iterable $value
 * @phpstan-assert iterable $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
function isIterable($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\isIterable($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected an iterable. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
