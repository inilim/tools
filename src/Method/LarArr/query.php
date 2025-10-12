<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Convert the array into a query string.
 *
 * @param  array  $array
 * @return string
 */
function query($array)
{
    return \http_build_query($array, '', '&', \PHP_QUERY_RFC3986);
}
