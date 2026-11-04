<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert object $value
 * @phpstan-assert object $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function object($value, $message = '')
{
    if (!\is_object($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an object. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value)
        ));
    }

    return $value;
}