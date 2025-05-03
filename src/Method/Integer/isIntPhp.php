<?php

namespace Inilim\Tool\Method\Integer;

/**
 * проверка int для php, 32bit или 64bit
 * может ли значение стать integer без изменений
 * @param mixed $v
 */
function isIntPHP($v): bool
{
    if (\Inilim\Tool\Method\Integer\isNumeric($v)) {
        /** @var string $v */
        if (\strval(\intval($v)) === \strval($v)) return true;
        return false;
    }
    return false;
}
