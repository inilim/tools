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
function nullOrStringNotEmpty($value, $message = ''): ?string
{
    null === $value || \Inilim\Tool\Method\Assert\stringNotEmpty($value, $message);

    return $value;
}