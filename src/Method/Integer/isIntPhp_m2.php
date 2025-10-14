<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * проверка int для php, 32bit или 64bit
 * может ли значение стать integer без изменений
 * @param mixed $value
 */
function isIntPhp_m2($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) {
        throw new \InvalidArgumentException('$value must be numeric');
    }
    /** @var string $value */
    return \strval(\intval($value)) === \strval($value) ? true : false;
}
