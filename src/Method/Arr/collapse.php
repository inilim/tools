<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Collapse an array of arrays into a single array.
 * @param  iterable  $array
 * @return array
 */
function collapse(iterable $array)
{
    $results = [];

    foreach ($array as $values) {
        if (!\is_array($values)) {
            continue;
        }

        $results[] = $values;
    }

    return \array_merge([], ...$results);
}
