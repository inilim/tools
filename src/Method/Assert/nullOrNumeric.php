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
function nullOrNumeric($value, $message = '')
{
    null === $value || \Inilim\Tool\Method\Assert\numeric($value, $message);

    return $value;
}