<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Convert a flatten "dot" notation array into an expanded array.
 *
 * @param  iterable  $array
 * @return array
 */
function undot($array)
{
    $results = [];

    $set = \Inilim\Tool\Method\LarArr\set();
    foreach ($array as $key => $value) {
        $set($results, $key, $value);
    }

    return $results;
}
