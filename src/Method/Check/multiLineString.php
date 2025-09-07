<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * @param mixed $value
 */
function multiLineString($value): bool
{
    return \is_string($value) && \preg_match("#\r\n?|\u{2028}|\u{2029}#", $value) === 1;
}
