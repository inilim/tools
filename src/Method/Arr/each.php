<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Execute a callback over each item.
 * @template V
 * @template K
 * @param \ArrayAccess<K,V>|array<K,V> $array
 * @param callable(V,K):mixed $callback
 * @return void
 */
function each($array, callable $callback)
{
    foreach ($array as $key => $item) {
        if ($callback($item, $key) === false) {
            break;
        }
    }
}
