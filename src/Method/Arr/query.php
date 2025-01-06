<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Convert the array into a query string.
 */
function query(array $array): string
{
    return \http_build_query($array, '', '&', \PHP_QUERY_RFC3986);
}
