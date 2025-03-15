<?php

namespace Inilim\Tool\Method\Arr;

/**
 * set if null OR empty string OR empty array
 * @return bool
 */
function setValueIfEmpty(array &$array, string $key, $value)
{
    $cur = \Inilim\Tool\Method\Arr\get($array, $key, -1);
    if (\in_array($cur, [null, '', []], true)) {
        \Inilim\Tool\Method\Arr\set($array, $key, $value);
        return true;
    }
    return false;
}
