<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return null|string|int
 */
function lastValue($enum)
{
    $case = \Inilim\Tool\Method\Enum\last($enum);
    return $case->value ?? null;
}
