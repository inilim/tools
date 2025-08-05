<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function file($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\string($value);
    if (!\is_file($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'The path %s is not a file.',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
