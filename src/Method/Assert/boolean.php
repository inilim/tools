<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert bool $value
 * @phpstan-assert bool $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function boolean($value, string $message = '')
{
    if (!\is_bool($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a bool. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
