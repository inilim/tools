<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * Run a map over each nested chunk of items.
 *
 * @template TKey
 * @template TValue
 *
 * @param  array<TKey, array>  $array
 * @param  callable(mixed...): TValue  $callback
 * @return array<TKey, TValue>
 */
function mapSpread(array $array, callable $callback): array
{
    return \Inilim\Tool\Method\LarArr\map($array, static function ($chunk, $key) use ($callback) {
        $chunk[] = $key;
        return $callback(...$chunk);
    });
}
