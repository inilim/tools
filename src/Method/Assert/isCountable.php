<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @psalm-pure
 * @psalm-assert countable $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function isCountable($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\isCountable($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a countable. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
