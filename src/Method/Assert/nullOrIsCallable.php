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
 * @return callable|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrIsCallable($value, $message = ''): ?callable
{
    null === $value || \Inilim\Tool\Method\Assert\isCallable($value, $message);

    return $value;
}