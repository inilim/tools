<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return T[]
 * @throws \InvalidArgumentException
 */
function cases($enum)
{
    \Inilim\Tool\Method\Assert\php81();
    if (!\Inilim\Tool\Method\Other\isEnum($enum)) {
        throw new \InvalidArgumentException('Must be of type \UnitEnum');
    }
    return $enum::cases();
}
