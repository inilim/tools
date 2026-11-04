<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert object|class-string $value
 * @phpstan-assert object|class-string $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function objectish($value, $message = '')
{
    if (!\is_object($value) && !\is_string($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an objectish value. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value)
        ));
    }

    if (\is_string($value) && !\class_exists($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected class to be defined. Got: %s',
            $value
        ));
    }

    return $value;
}