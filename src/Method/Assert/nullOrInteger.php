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
 * @return int|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrInteger($value, $message = ''): ?int
{
    null === $value || \Inilim\Tool\Method\Assert\integer($value, $message);

    return $value;
}