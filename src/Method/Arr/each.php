<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Execute a callback over each item.
 * @template TValue
 * @template TKey
 * @param callable(TValue,TKey): mixed $callback
 */
function each(array $array, callable $callback): void
{
    foreach ($array as $key => $item) {
        if ($callback($item, $key) === false) {
            break;
        }
    }
}
