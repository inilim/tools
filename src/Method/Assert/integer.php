<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int $value
 * @phpstan-assert int $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function integer($value, string $message = '')
{
    if (!\is_int($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected an integer. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
