<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-assert class-string $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function classExists($value, string $message = '')
{
    if (!\class_exists($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected an existing class name. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
