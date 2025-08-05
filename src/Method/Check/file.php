<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * 
 * @param mixed  $value
 */
function file($value): bool
{
    return \is_string($value) && \is_file($value);
}
