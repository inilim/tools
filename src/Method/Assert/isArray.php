<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert mixed[] $value
 * @phpstan-assert mixed[] $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function isArray($value, string $message = '')
{
    if (!\is_array($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a array. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
