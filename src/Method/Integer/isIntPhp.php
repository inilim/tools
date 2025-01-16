<?php

namespace Inilim\Tool\Method\Integer;

\Inilim\Tool\Integer::__include('isNumeric');

/**
 * проверка int для php, 32bit или 64bit
 * может ли значение стать integer без изменений
 * @param mixed $v
 * @return bool
 */
function isIntPHP($v)
{
    if (isNumeric($v)) {
        /** @var string $v */
        if (\strval(\intval($v)) === \strval($v)) return true;
        return false;
    }
    return false;
}
