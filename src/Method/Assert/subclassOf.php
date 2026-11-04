<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template ExpectedType of object
 * @psalm-assert class-string<ExpectedType> $value
 * @phpstan-assert class-string<ExpectedType> $value
 *
 * @param mixed $value
 * @param class-string<ExpectedType> $class
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function subclassOf($value, $class, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value);
    \Inilim\Tool\Method\Assert\string($class);

    if (!\is_subclass_of($value, $class)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a sub-class of %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \Inilim\Tool\Method\Other\valueToString($class)
        ));
    }

    return $value;
}