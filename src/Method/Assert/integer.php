<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int $value
 * @phpstan-assert int $value
 * 
 * @template T
 * @return T
 * @param mixed  $value
 * @param string|callable():string $message
 * @throws \InvalidArgumentException
 */
function integer($value, $message = '')
{
    if (!\is_int($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an integer. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value)
        ));
    }

    return $value;
}
