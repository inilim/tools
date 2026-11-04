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
function unicodeLetters($value, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value, $message);

    if (!\preg_match('/^\p{L}+$/u', $value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to contain only Unicode letters. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }

    return $value;
}