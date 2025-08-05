<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * @psalm-assert T|class-string<T> $value
 * @phpstan-assert T|class-string<T> $value
 * 
 * 
 * @param object|string $value
 * @param class-string<T>[] $classes
 * @throws \InvalidArgumentException
 */
function isAnyOf($value, array $classes, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\isAnyOf($value, $classes)) {
        throw new \InvalidArgumentException(sprintf(
            $message ?: 'Expected an instance of any of this classes or any of those classes among their parents "%2$s". Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \implode(', ', $classes)
        ));
    }
}
