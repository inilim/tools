<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function readable($value, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value);

    if (!\is_readable($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'The path %s is not readable.',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }

    return $value;
}