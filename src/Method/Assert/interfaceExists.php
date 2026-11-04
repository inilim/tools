<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-assert class-string $value
 * @phpstan-assert class-string $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function interfaceExists($value, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value);

    if (!\interface_exists($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an existing interface name. got %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }

    return $value;
}