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
 * @return bool|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrBoolean($value, $message = ''): ?bool
{
    null === $value || \Inilim\Tool\Method\Assert\boolean($value, $message);

    return $value;
}