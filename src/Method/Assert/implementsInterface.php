<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template ExpectedType of object
 * @psalm-assert class-string<ExpectedType>|ExpectedType $value
 * @phpstan-assert class-string<ExpectedType>|ExpectedType $value
 *
 * @param mixed $value
 * @param class-string<ExpectedType> $interface
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function implementsInterface($value, $interface, $message = '')
{
    \Inilim\Tool\Method\Assert\objectish($value);

    $implements = \class_implements($value);

    \Inilim\Tool\Method\Assert\isArray($implements);

    if (!\in_array($interface, $implements, true)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an implementation of %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \Inilim\Tool\Method\Other\valueToString($interface)
        ));
    }

    return $value;
}