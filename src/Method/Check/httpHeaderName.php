<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author inilim
 * @psalm-assert string $value
 * @phpstan-assert string $value
 *
 * @param mixed $value
 */
function httpHeaderName($value): bool
{
    return \is_string($value) && (bool)\preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/D', $value);
}
