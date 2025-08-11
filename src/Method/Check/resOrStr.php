<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert-if-true resource|string $value
 * @phpstan-assert-if-true resource|string $value
 * 
 * 
 * @param mixed       $value
 * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
 */
function resOrStr($value, ?string $type = null): bool
{
    if (\is_string($value)) {
        return true;
    }
    if (!\is_resource($value)) {
        return false;
    }
    if ($type !== null && $type !== \get_resource_type($value)) {
        return false;
    }
    return true;
}
