<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determines if an array is associative.
 *
 * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
 *
 * @param  array  $array
 * @return ($array is list ? false : true)
 */
function isAssoc(array $array)
{
    return ! \Inilim\Tool\Method\PF\array_is_list($array);
}
