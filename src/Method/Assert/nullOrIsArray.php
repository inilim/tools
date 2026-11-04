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
 * @return array|null
 *
 * @throws \InvalidArgumentException
 */
function nullOrIsArray($value, $message = ''): ?array
{
    null === $value || \Inilim\Tool\Method\Assert\isArray($value, $message);

    return $value;
}