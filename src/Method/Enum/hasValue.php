<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @param int|string $value
 */
function hasValue($enum, $value, bool $caseInsensitive = false)
{
    return \Inilim\Tool\Method\Enum\tryFromValue($enum, $value, $caseInsensitive) !== null;
}
