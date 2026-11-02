<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @psalm-assert-if-true !empty $value
 * @phpstan-assert-if-true !empty $value
 * @param mixed $value
 */
function notEmpty($value): bool
{
    return !empty($value);
}
