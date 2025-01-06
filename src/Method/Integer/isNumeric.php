<?php

namespace Inilim\Method\Integer;

/**
 * функция не проверяет длину значения, будет true даже с bigint и более.
 * @param mixed $v
 */
function isNumeric($v): bool
{
    if (!\is_scalar($v) || \is_bool($v)) return false;
    // here string|int|float
    // if (\preg_match('#^0$#', $v) || \preg_match('#^\-?[1-9][0-9]{0,}$#', $v)) return true;
    if (\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#', \strval($v))) return true;
    return false;
}
