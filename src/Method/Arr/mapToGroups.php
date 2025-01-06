<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('map');

/**
 * Run a grouping map over the items.
 * The callback should return an associative array with a single key/value pair.
 * @template TValue
 * @template TKey
 * @param array<TKey,TValue> $array
 * @param callable(TValue,TKey) $callback
 */
function mapToGroups(array $array, callable $callback): array
{
    return \array_reduce(
        \Inilim\Tool\Method\Arr\map($array, $callback),
        static function ($groups, $pair) {
            $groups[\key($pair)][] = \reset($pair);
            return $groups;
        }
    );
}
