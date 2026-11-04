<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 *
 * @param mixed $array
 * @param mixed $max
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function maxCount($array, $max, $message = '')
{
    \Inilim\Tool\Method\Assert\isCountable($array);
    \Inilim\Tool\Method\Assert\integerish($max);

    if (\count($array) > $max) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an array to contain at most %2$d elements. Got: %d',
            \count($array),
            $max
        ));
    }

    return $array;
}