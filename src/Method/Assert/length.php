<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $value
 * @param mixed $length
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function length($value, $length, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value);
    \Inilim\Tool\Method\Assert\integerish($length);

    if ($length !== \Inilim\Tool\Method\Assert\__strlen($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to contain %2$s characters. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            $length
        ));
    }

    return $value;
}