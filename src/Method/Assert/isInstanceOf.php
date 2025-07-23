<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-template ExpectedType of object
 * @psalm-param class-string<ExpectedType> $class
 * @psalm-assert ExpectedType $value
 * @param mixed         $value
 * @param string|object $class
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
