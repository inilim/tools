<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * проверка int для php, 32bit или 64bit
 * может ли значение стать integer без изменений
 * @param mixed $value
 */
function isIntPhp($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) {
        return false;
    }
    /** @var string $value */
    return \strval(\intval($value)) === \strval($value) ? true : false;
}
