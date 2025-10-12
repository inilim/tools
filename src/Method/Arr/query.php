<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * Convert the array into a query string.
 */
function query(array $array): string
{
    return \http_build_query($array, '', '&', \PHP_QUERY_RFC3986);
}
