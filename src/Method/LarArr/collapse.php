<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Collapse an array of arrays into a single array.
 *
 * @param  iterable  $array
 * @return array
 */
function collapse($array)
{
    $results = [];

    foreach ($array as $values) {
        // if ($values instanceof Collection) {
        // $results[] = $values->all();
        if ($values instanceof \Traversable) {
            $values = \iterator_to_array($values);
        } elseif (is_array($values)) {
            $results[] = $values;
        }
    }

    return \array_merge([], ...$results);
}
