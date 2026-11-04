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
 * @param string $prefix
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function notStartsWith($value, $prefix, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value);
    \Inilim\Tool\Method\Assert\string($prefix);

    if (\strncmp($value, $prefix, \strlen($prefix)) === 0) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value not to start with %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \Inilim\Tool\Method\Other\valueToString($prefix)
        ));
    }

    return $value;
}