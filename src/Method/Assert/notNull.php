<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert !null $value
 * @phpstan-assert !null $value
 *
 * @template T
 * @param T|null $value
 * @param string|callable():string $message
 *
 * @return T
 *
 * @throws \InvalidArgumentException
 */
function notNull($value, $message = '')
{
    if (null === $value) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(
            $message ?: 'Expected a value other than null.'
        );
    }

    return $value;
}