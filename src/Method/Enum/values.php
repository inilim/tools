<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return string[]|int[]
 */
function values($enum)
{
    return \array_column(\Inilim\Tool\Method\Enum\cases($enum), 'value');
}
