<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @param \UnitEnum $enum
 * @param \UnitEnum $needle
 * @return bool
 */
function isNot(object $enum, object $needle)
{
    return !\Inilim\Tool\Method\Enum\is($enum, $needle);
}
