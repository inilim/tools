<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Convert a flatten "dot" notation array into an expanded array.
 * @param  iterable  $array
 */
function undot($array): array
{
    $results = [];

    foreach ($array as $key => $value) {
        \Inilim\Tool\Method\Arr\set()($results, $key, $value);
    }

    return $results;
}
