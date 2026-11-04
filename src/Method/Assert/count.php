<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 *
 * @param mixed $array
 * @param mixed $number
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function count($array, $number, $message = '')
{
    \Inilim\Tool\Method\Assert\isCountable($array);
    \Inilim\Tool\Method\Assert\integerish($number);

    \Inilim\Tool\Method\Assert\eq(
        \count($array),
        $number,
        static function () use ($message, $number, $array) {
            return \Inilim\Tool\Method\Assert\__resolveMessage($message) ?: \sprintf(
                $message ?: 'Expected an array to contain %d elements. Got: %d.',
                $number,
                \count($array)
            );
        }
    );

    return $array;
}