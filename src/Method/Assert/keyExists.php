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
 * @param K $key
 * @throws \InvalidArgumentException
 */
function keyExists($value, $key, string $message = '')
{
    \Inilim\Tool\Method\Assert\keysExists($value, [$key], $message);
}
