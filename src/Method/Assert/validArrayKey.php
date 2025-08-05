<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * Checks if a value is a valid array key (int or string).
 * @psalm-pure
 * @psalm-assert int|string $value
 * @phpstan-assert int|string $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function validArrayKey($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\validArrayKey($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected string or integer. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
