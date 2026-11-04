<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert array|\ArrayAccess $value
 * @phpstan-assert array|\ArrayAccess $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function isArrayAccessible($value, $message = '')
{
    if (!\is_array($value) && !($value instanceof \ArrayAccess)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an array accessible. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value)
        ));
    }

    return $value;
}