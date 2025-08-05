<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @template T of mixed
 * @psalm-assert-if-true \UnitEnum $value
 * @phpstan-assert-if-true \UnitEnum $value
 * 
 * @param T $v
 */
function enumCase($v): bool
{
    if (!\is_object($v) || \PHP_VERSION_ID < 80100) {
        return false;
    }

    return $v instanceof \UnitEnum;
}
