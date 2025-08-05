<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * @psalm-assert T $value
 * @phpstan-assert T $value
 * 
 * @param mixed                $value
 * @param array<T|class-string<T>> $classes
 * @throws \InvalidArgumentException
 */
function isInstanceOfAny($value, array $classes, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\isInstanceOfAny($value, $classes)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected an instance of any of %2$s. Got: %s',
            \Inilim\Tool\Method\Other\getType($value),
            // @deps(\Inilim\Tool\Method\Other\valueToString)
            \implode(', ', \array_map('\Inilim\Tool\Method\Other\valueToString', $classes))
        ));
    }
}
