<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * @psalm-assert T $value
 * @phpstan-assert T $value
 * 
 * 
 * @param mixed $value
 * @param T|class-string<T> $class
 * @throws \InvalidArgumentException
 */
function isInstanceOf($value, $class, string $message = '')
{
    if (!($value instanceof $class)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected an instance of %2$s. Got: %s',
            \Inilim\Tool\Method\Other\getType($value),
            $class
        ));
    }
}
