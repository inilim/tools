<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-param array<class-string> $classes
 * @param object|string $value
 * @param string[]      $classes
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
