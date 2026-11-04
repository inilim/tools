<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * 
 * @psalm-pure
 *
 * @template T of object
 *
 * @psalm-assert T $value
 * @phpstan-assert T $value
 *
 * @param string|callable():string $message
 * @param class-string<T> $class
 *
 * @return T
 *
 * @throws \InvalidArgumentException
 */
function isInstanceOf($value, $class, $message = '')
{
    \Inilim\Tool\Method\Assert\string($class, 'Expected class as a string. Got: %s');

    if (!($value instanceof $class)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an instance of %2$s. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value),
            $class
        ));
    }

    return $value;
}
