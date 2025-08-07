<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author inilim
 * @psalm-pure
 * @psalm-assert mixed[] $value
 * @phpstan-assert mixed[] $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
function isNonEmptyArray($value, string $message = '')
{
    \Inilim\Tool\Method\Assert\isArray($value);

    if (empty($value)) {
        throw new \InvalidArgumentException($message ?: 'Expected a non-empty array.');
    }
}
