<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return int
 */
function count($enum)
{
    return \sizeof(\Inilim\Tool\Method\Enum\cases($enum));
}
