<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * Checks if a value is a valid array key (int or string).
 * @psalm-pure
 * @param mixed  $value
 */
function validArrayKey($value): bool
{
    return \is_int($value) || \is_string($value);
}
