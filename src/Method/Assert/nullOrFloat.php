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
 * @return float|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrFloat($value, $message = ''): ?float
{
    null === $value || \Inilim\Tool\Method\Assert\float($value, $message);

    return $value;
}