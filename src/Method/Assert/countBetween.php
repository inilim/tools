<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 *
 * @param mixed $array
 * @param mixed $min
 * @param mixed $max
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function countBetween($array, $min, $max, $message = '')
{
    \Inilim\Tool\Method\Assert\isCountable($array);
    \Inilim\Tool\Method\Assert\integerish($min);
    \Inilim\Tool\Method\Assert\integerish($max);

    $count = \count($array);

    if ($count < $min || $count > $max) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an array to contain between %2$d and %3$d elements. Got: %d',
            $count,
            $min,
            $max
        ));
    }

    return $array;
}