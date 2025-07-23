<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-param array<class-string> $classes
 * @param mixed                $value
 * @param array<object|string> $classes
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
