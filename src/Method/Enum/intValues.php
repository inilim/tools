<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return bool
 */
function intValues($enum)
{
    return \Inilim\Tool\Method\Enum\typeValues($enum) === 'int';
}
