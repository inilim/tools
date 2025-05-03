<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 */
function hasValues($enum): bool
{
    \Inilim\Tool\Method\Assert\php81();

    if (\is_object($enum) && $enum instanceof \BackedEnum) {
        return true;
    }

    return \Inilim\Tool\Method\Enum\head($enum) instanceof \BackedEnum;
}
