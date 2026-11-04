<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $value
 * @param mixed $max
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function maxLength($value, $max, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value);
    \Inilim\Tool\Method\Assert\integerish($max);

    if (\Inilim\Tool\Method\Assert\__strlen($value) > $max) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to contain at most %2$s characters. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            $max
        ));
    }

    return $value;
}