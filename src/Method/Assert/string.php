<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert string $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function string($value, string $message = '')
{
    if (!\is_string($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a string. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
