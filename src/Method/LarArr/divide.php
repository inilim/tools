<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Divide an array into two arrays. One with keys and the other with values.
 *
 * @param  array  $array
 * @return array
 */
function divide($array)
{
    return [\array_keys($array), \array_values($array)];
}
