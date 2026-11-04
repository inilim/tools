<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @template T of object
 * @psalm-assert object $value
 * @phpstan-assert object $value
 *
 * @param mixed $value
 * @param class-string<T> $class
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function notInstanceOf($value, $class, $message = '')
{
    \Inilim\Tool\Method\Assert\string($class, 'Expected class as a string. Got: %s');

    if (!\is_object($value) || $value instanceof $class) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an instance other than %2$s. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value),
            $class
        ));
    }

    return $value;
}