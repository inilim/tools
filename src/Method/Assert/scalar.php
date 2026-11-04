<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert scalar $value
 * @phpstan-assert scalar $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function scalar($value, $message = '')
{
    if (!\is_scalar($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a scalar. Got: %s',
            \Inilim\Tool\Method\Assert\__typeToString($value)
        ));
    }

    return $value;
}