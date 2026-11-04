<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert string $value
 * @phpstan-assert string $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function ipv4($value, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value, $message);

    if (false === \filter_var($value, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV4)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to be an IPv4. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }

    return $value;
}