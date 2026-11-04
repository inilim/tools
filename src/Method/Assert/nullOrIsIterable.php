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
 * @return iterable|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrIsIterable($value, $message = ''): ?iterable
{
    null === $value || \Inilim\Tool\Method\Assert\isIterable($value, $message);

    return $value;
}