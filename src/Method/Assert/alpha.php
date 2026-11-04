<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert string $value
 * @phpstan-assert string $value
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function alpha($value, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value, $message);

    $locale = \setlocale(\LC_CTYPE, '0');
    \setlocale(\LC_CTYPE, 'C');
    $valid = !\ctype_alpha($value);
    \setlocale(\LC_CTYPE, $locale);

    if ($valid) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to contain only letters. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }

    return $value;
}