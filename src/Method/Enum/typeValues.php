<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return null|('int'|'string')
 */
function typeValues($enum): ?string
{
    $case = \Inilim\Tool\Method\Enum\firstValue($enum);
    $type = \Inilim\Tool\Method\Other\getType($case);
    if ($type === 'null') {
        return null;
    }

    return $type;
}
