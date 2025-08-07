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
function httpHeaderName($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\string($value, $message ?: 'Header name must be a string but %s provided.');

    if (!\Inilim\Tool\Method\Check\httpHeaderName($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: '"%s" is not valid header name.',
            $value
        ));
    }
}
