<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @param \UnitEnum $enum
 * @param \UnitEnum $needle
 * @return bool
 */
function is(object $enum, object $needle)
{
    \Inilim\Tool\Method\Assert\enumCase($needle);
    return \Inilim\Tool\Method\Enum\in($enum, [$needle]);
}
