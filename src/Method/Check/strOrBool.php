<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string|bool $value
 * @phpstan-assert-if-true string|bool $value
 * 
 * 
 * @param mixed $value
 */
function strOrBool($value): bool
{
    return \is_string($value) || \is_bool($value);
}
