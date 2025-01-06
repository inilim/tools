<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('set');

/**
 * Convert a flatten "dot" notation array into an expanded array.
 * @param  iterable  $array
 */
function undot($array): array
{
    $results = [];

    foreach ($array as $key => $value) {
        \Inilim\Method\Arr\set($results, $key, $value);
    }

    return $results;
}
