<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert numeric $value
 * @phpstan-assert numeric $value
 * 
 * @template T
 * 
 * @param mixed  $value
 * @param string|callable():string $message
 * @return T
 * @throws \InvalidArgumentException
 */
function integerish($value, $message = '')
{
    if (!\is_numeric($value) || $value != (int) $value) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an integerish value. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value)
        ));
    }

    return $value;
}
