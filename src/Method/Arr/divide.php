<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Divide an array into two arrays. One with keys and the other with values.
 */
function divide(array $array): array
{
    return [\array_keys($array), \array_values($array)];
}
