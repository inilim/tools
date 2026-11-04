<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * 
 * @template T
 * @return T
 * @param mixed  $value
 * @param mixed  $expect
 * @param string|callable():string $message
 * @throws \InvalidArgumentException
 */
function notEq($value, $expect, $message = '')
{
    if ($expect == $value) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a different value than %s.',
            \Inilim\Tool\Method\Other\valueToString($expect)
        ));
    }

    return $value;
}
