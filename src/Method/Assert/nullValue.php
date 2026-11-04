<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert null $value
 * @phpstan-assert null $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function nullValue($value, $message = '')
{
    if (null !== $value) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected null. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }

    return $value;
}