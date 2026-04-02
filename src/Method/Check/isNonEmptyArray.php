<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true mixed[] $value
 * @phpstan-assert-if-true mixed[] $value
 * 
 * 
 * @param mixed $value
 */
function isNonEmptyArray($value): bool
{
    return \is_array($value) && $value !== [];
}
