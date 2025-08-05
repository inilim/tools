<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * @param mixed $value
 */
function isJson($value): bool
{
    if (!\is_string($value)) {
        return false;
    }
    return \Inilim\Tool\Method\PF\json_validate($value);
}
