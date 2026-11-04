<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $value
 * @param string|callable():string $message
 *
 * @return object|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrObject($value, $message = ''): ?object
{
    null === $value || \Inilim\Tool\Method\Assert\object($value, $message);

    return $value;
}