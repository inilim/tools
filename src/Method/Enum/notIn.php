<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @param \UnitEnum $enum
 * @param \UnitEnum[] $haystack
 */
function notIn(object $enum, array $haystack): bool
{
    return !\Inilim\Tool\Method\Enum\in($enum, $haystack);
}
