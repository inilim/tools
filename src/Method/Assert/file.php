<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function file($value, string $message = '')
{
    if (!\is_file($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'The path %s is not a file.',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
