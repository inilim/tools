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
 * @return \Countable|array|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrIsCountable($value, $message = '')
{
    null === $value || \Inilim\Tool\Method\Assert\isCountable($value, $message);

    return $value;
}