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
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function range($value, $min, $max, $message = '')
{
    if ($value < $min || $value > $max) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value between %2$s and %3$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \Inilim\Tool\Method\Other\valueToString($min),
            \Inilim\Tool\Method\Other\valueToString($max)
        ));
    }

    return $value;
}