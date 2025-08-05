<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author webmozarts/assert
 * Checks if a value is a valid array key (int or string).
 * @psalm-pure
 * @psalm-assert-if-true int|string $value
 * @phpstan-assert-if-true int|string $value
 * 
 * @param mixed  $value
 */
function validArrayKey($value): bool
{
    return \is_int($value) || \is_string($value);
}
