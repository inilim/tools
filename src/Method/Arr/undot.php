<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Convert a flatten "dot" notation array into an expanded array.
 * @param  iterable  $array
 */
function undot($array): array
{
    $results = [];
    $set = \Inilim\Tool\Method\Arr\set();
    foreach ($array as $key => $value) {
        $set($results, $key, $value);
    }

    return $results;
}
