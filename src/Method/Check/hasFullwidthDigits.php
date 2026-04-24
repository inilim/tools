<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author deepseek
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * @param mixed $value
 * @todo tests
 */
function hasFullwidthDigits($value): bool
{
    return \is_string($value) && \preg_match('/[\x{FF10}-\x{FF19}]/u', $value) === 1;
}
