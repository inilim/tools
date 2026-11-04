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
 * @return int|float|bool|string|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrScalar($value, $message = '')
{
    null === $value || \Inilim\Tool\Method\Assert\scalar($value, $message);

    return $value;
}