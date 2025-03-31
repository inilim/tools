<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return T
 */
function head($enum)
{
    return \Inilim\Tool\Method\Arr\head(
        \Inilim\Tool\Method\Enum\cases($enum)
    );
}
