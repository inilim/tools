<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'get',
    'set',
]);

/**
 * set if null OR empty string OR empty array
 */
function setValueIfEmpty(array &$array, string $key_dot, $value): bool
{
    $cur = \Inilim\Method\Arr\get($array, $key_dot);
    if (\in_array($cur, [null, '', []], true)) {
        \Inilim\Method\Arr\set($array, $key_dot, $value);
        return true;
    }
    return false;
}
