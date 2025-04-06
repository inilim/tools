<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 */
function hasName($enum, string $name, bool $caseInsensitive = false)
{
    return \Inilim\Tool\Method\Enum\tryFromName($enum, $name, $caseInsensitive) !== null;
}
