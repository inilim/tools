<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * Does strict comparison, so Assert::inArray(3, ['3']) does not pass the assertion.
 * @psalm-pure
 * @param mixed  $value
 * @param array  $values
 * @throws \InvalidArgumentException
 */
function inArray($value, array $values, string $message = '')
{
    if (!\in_array($value, $values, true)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected one of: %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            // @deps(\Inilim\Tool\Method\Other\valueToString)
            \implode(', ', \array_map('\Inilim\Tool\Method\Other\valueToString', $values))
        ));
    }
}
