<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * @todo add support \IteratorAggregate
 * Collapse an array of arrays into a single array.
 */
function collapse(iterable $array): array
{
    $results = [];

    foreach ($array as $values) {
        if ($values instanceof \Traversable) {
            $values = \iterator_to_array($values);
        } elseif (!\is_array($values)) {
            continue;
        }

        $results[] = $values;
    }

    return \array_merge([], ...$results);
}
