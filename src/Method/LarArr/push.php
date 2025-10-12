<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Push an item into an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int|null  $key
 * @param  mixed  $values
 * @return \Closure(ArrayAccess|array &$array, string|int|null $key, mixed ...$values):array
 */
function push(): \Closure
{
    return static function ($array, $key, ...$values) {
        $target = \Inilim\Tool\Method\LarArr\_array($array, $key, []);

        \array_push($target, ...$values);

        return \Inilim\Tool\Method\LarArr\set()($array, $key, $target);
    };
}
