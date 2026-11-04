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
 * @return object|string|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrObjectish($value, $message = '')
{
    null === $value || \Inilim\Tool\Method\Assert\objectish($value, $message);

    return $value;
}