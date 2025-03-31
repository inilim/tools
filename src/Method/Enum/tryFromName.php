<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return ?T
 */
function tryFromName($enum, string $name, bool $caseInsensitive = false)
{
    foreach (\Inilim\Tool\Method\Enum\cases($enum) as $enum) {
        if (
            \Inilim\Tool\Method\Enum\__uniform($enum->name, $caseInsensitive)
            ===
            \Inilim\Tool\Method\Enum\__uniform($name, $caseInsensitive)
        ) {
            return $enum;
        }
    }

    return null;
}
