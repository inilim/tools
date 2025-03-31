<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @param int|string $value
 * @return string
 */
function __uniform($value, bool $caseInsensitive)
{
    return $caseInsensitive ? \Inilim\Tool\Method\Str\lower(\strval($value)) : $value;
}
