<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @deprecated use patternRegex
 * check is valid regex
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * @param mixed  $value
 */
function regex($value): bool
{
    return \Inilim\Tool\Method\Check\patternRegex($value);
}
