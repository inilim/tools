<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function directory($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\string($value);
    if (!\is_dir($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'The path %s is not a directory.',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
