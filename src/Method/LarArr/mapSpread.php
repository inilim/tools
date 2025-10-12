<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Run a map over each nested chunk of items.
 *
 * @template TKey
 * @template TValue
 *
 * @param  array<TKey, array>  $array
 * @param  callable(mixed...): TValue  $callback
 * @return array<TKey, TValue>
 */
function mapSpread(array $array, callable $callback)
{
    return \Inilim\Tool\Method\LarArr\map($array, function ($chunk, $key) use ($callback) {
        $chunk[] = $key;

        return $callback(...$chunk);
    });
}
