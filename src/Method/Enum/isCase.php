<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @param mixed $v
 */
function isCase($v): bool
{
    if (\PHP_VERSION_ID < 80100) {
        return false;
    }

    return $v instanceof \UnitEnum;
}
