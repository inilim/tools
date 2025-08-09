<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * 
 *
 * @param mixed $value
 */
function contains($value, string $subString, bool $ingnoreCase = false): bool
{
    return \is_string($value)
        &&
        ($ingnoreCase
            ? \Inilim\Tool\Method\Str\iContainsOnce($value, $subString)
            : \Inilim\Tool\Method\PF\str_contains($value, $subString));
}
