<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * Does strict comparison, so Assert::notInArray(3, ['3']) does not pass the assertion.
 * @psalm-pure
 * @template T1 of mixed
 * @template T2 of mixed
 * @psalm-assert T1 $value
 * @phpstan-assert T1 $value
 * 
 * @param T1 $value
 * @param T2[] $values
 * @throws \InvalidArgumentException
 */
function notInArray($value, array $values, string $message = '')
{
    if (\in_array($value, $values, true)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Not expected one of: %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            // @deps(\Inilim\Tool\Method\Other\valueToString)
            \implode(', ', \array_map('\Inilim\Tool\Method\Other\valueToString', $values))
        ));
    }
}
