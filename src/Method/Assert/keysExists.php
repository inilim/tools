<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author inilim
 * @psalm-pure
 * @template K of int|string
 * @psalm-assert array<K,mixed> $value
 * @phpstan-assert array<K,mixed> $value
 * 
 * @param mixed $value
 * @param K[] $keys
 * @throws \InvalidArgumentException
 */
function keysExists($value, array $keys, string $message = '')
{
    \Inilim\Tool\Method\Assert\isArray($value);
    if (!\Inilim\Tool\Method\LarArr\hasAll($value, $keys)) {
        // @deps(\Inilim\Tool\Method\Other\valueToString)
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected all of: %2$s. Got: %s',
            \implode(', ', \array_map('\Inilim\Tool\Method\Other\valueToString', \array_keys($value))),
            \implode(', ', \array_map('\Inilim\Tool\Method\Other\valueToString', $keys))
        ));
    }
}
