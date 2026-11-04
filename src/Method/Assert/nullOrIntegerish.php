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
 * @return int|float|string|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrIntegerish($value, $message = '')
{
    null === $value || \Inilim\Tool\Method\Assert\integerish($value, $message);

    return $value;
}