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
function integerish($value, string $message = '')
{
    if (!\is_numeric($value) || $value != (int) $value) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected an integerish value. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
