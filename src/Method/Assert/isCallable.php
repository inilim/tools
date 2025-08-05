<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-assert callable $value
 * @phpstan-assert callable $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function isCallable($value, string $message = '')
{
    if (!\is_callable($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a callable. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
