<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * 
 * @param mixed  $value
 */
function dir($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\string($value);
    if (!\is_dir($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'The path %s is not a directory.',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
