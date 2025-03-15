<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @template T of array
 * @param T $array
 * @return T
 */
function keysLower(array $array)
{
    return \array_change_key_case($array, \CASE_LOWER);
}
