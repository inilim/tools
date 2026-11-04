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
 * @param string $suffix
 * @param string|callable():string $message
 *
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function endsWith($value, $suffix, $message = ''): string
{
    \Inilim\Tool\Method\Assert\string($value);
    \Inilim\Tool\Method\Assert\string($suffix);

    if ($suffix !== '' && \substr($value, -\strlen($suffix)) !== $suffix) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to end with %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \Inilim\Tool\Method\Other\valueToString($suffix)
        ));
    }

    return $value;
}