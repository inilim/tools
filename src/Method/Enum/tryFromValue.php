<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \BackedEnum
 * @param class-string<T>|T $enum
 * @param int|string $value
 * @return ?T
 */
function tryFromValue($enum, $value, bool $caseInsensitive = false)
{
    $backed = false;

    foreach (\Inilim\Tool\Method\Enum\cases($enum) as $enum) {

        if (!$backed && !($backed = $enum instanceof \BackedEnum)) {
            return null;
        }

        if (
            \Inilim\Tool\Method\Enum\__uniform($enum->value, $caseInsensitive)
            ===
            \Inilim\Tool\Method\Enum\__uniform($value, $caseInsensitive)
        ) {
            return $enum;
        }
    }

    return null;
}
