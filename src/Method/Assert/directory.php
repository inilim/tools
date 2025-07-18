<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function directory($value, string $message = '')
{
    if (!\is_dir($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'The path %s is not a directory.',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
