<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true mixed[]|\Countable $value
 */
function countable($value): bool
{
    if (\is_array($value) || $value instanceof \Countable) {
        return true;
    }
    return false;
}
