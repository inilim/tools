<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 *
 * @param mixed $array
 * @param mixed $min
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function minCount($array, $min, $message = '')
{
    \Inilim\Tool\Method\Assert\isCountable($array);
    \Inilim\Tool\Method\Assert\integerish($min);

    if (\count($array) < $min) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected an array to contain at least %2$d elements. Got: %d',
            \count($array),
            $min
        ));
    }

    return $array;
}