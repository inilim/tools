<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert numeric $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function numeric($value, string $message = '')
{
    if (!\is_numeric($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a numeric. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
