<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $value
 * @param mixed $expect
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function notSame($value, $expect, $message = '')
{
    if ($expect === $value) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value not identical to %s.',
            \Inilim\Tool\Method\Other\valueToString($expect)
        ));
    }

    return $value;
}