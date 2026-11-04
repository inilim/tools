<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert !false $value
 * @phpstan-assert !false $value
 *
 * @template T
 * @param T|false $value
 * @param string|callable():string $message
 *
 * @return T
 *
 * @throws \InvalidArgumentException
 */
function notFalse($value, $message = '')
{
    if (false === $value) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(
            $message ?: 'Expected a value other than false.'
        );
    }

    return $value;
}