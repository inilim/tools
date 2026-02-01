<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determines if an array is a list.
 *
 * An array is a "list" if all array keys are sequential integers starting from 0 with no gaps in between.
 *
 * @param  array  $array
 * @return ($array is list ? true : false)
 */
function isList($array)
{
    return \Inilim\Tool\Method\PF\array_is_list($array);
}
