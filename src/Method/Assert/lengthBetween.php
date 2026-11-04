<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $value
 * @param mixed $min
 * @param mixed $max
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function lengthBetween($value, $min, $max, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value);
    \Inilim\Tool\Method\Assert\integerish($min);
    \Inilim\Tool\Method\Assert\integerish($max);

    $length = \Inilim\Tool\Method\Assert\__strlen($value);

    if ($length < $min || $length > $max) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to contain between %2$s and %3$s characters. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            $min,
            $max
        ));
    }

    return $value;
}