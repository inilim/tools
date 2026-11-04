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
 * @return string|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrEmail($value, $message = ''): ?string
{
    null === $value || \Inilim\Tool\Method\Assert\email($value, $message);

    return $value;
}