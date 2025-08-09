<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author inilim
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * @param mixed $value
 *
 * @throws \InvalidArgumentException
 */
function contains($value, string $subString, bool $ingnoreCase = false, string $message = '')
{
    \Inilim\Tool\Method\Assert\string($value);
    if (!\Inilim\Tool\Method\Check\contains($value, $subString, $ingnoreCase)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a value to contain %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \Inilim\Tool\Method\Other\valueToString($subString)
        ));
    }
}
