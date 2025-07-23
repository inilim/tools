<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @psalm-pure
 * @param mixed  $value
 */
function natural($value): bool
{
    return \is_int($value) && $value >= 0;
}
