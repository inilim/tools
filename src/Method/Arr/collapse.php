<?php

namespace Inilim\Method\Arr;

/**
 * Collapse an array of arrays into a single array.
 * @param  iterable  $array
 */
function collapse(iterable $array): array
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
