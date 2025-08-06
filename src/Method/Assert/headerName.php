<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author guzzle/guzzle
 * @see https://datatracker.ietf.org/doc/html/rfc7230#section-3.2
 * @psalm-assert string $value
 * @phpstan-assert string $value
 *
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
function headerName($value, string $message = '')
{
    if (!\is_string($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Header name must be a string but %s provided.',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }

    if (!\preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/D', $value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: '"%s" is not valid header name.',
            $value
        ));
    }
}
