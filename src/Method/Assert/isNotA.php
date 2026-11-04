<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T
 * @psalm-assert object|class-string $value
 * @phpstan-assert object|class-string $value
 *
 * @param mixed $value
 * @param class-string<T> $class
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function isNotA($value, $class, $message = '')
{
    \Inilim\Tool\Method\Assert\objectish($value, $message);
    \Inilim\Tool\Method\Assert\string($class, 'Expected class as a string. Got: %s');

    if (\is_a($value, $class, \is_string($value))) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an instance of this class or to this class among its parents other than "%2$s". Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            $class
        ));
    }

    return $value;
}