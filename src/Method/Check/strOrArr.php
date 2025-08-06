<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string|mixed[] $value
 * @phpstan-assert-if-true string|mixed[] $value
 * 
 * 
 * @param mixed $value
 */
function strOrArr($value): bool
{
    return \is_string($value) || \is_array($value);
}
