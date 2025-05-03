<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 */
function intValues($enum): bool
{
    return \Inilim\Tool\Method\Enum\typeValues($enum) === 'int';
}
