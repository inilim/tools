<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert float $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function float($value, string $message = '')
{
    if (!\is_float($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a float. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
