<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * @template T
 * @return T
 * @param mixed $value
 * @param string|callable $message
 * @throws \InvalidArgumentException
 */
function string($value, $message = '')
{
    if (!\is_string($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);

        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a string. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value)
        ));
    }

    return $value;
}
